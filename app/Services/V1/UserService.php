<?php

namespace App\Services\V1;

use App\Factories\LegalPersonFactory;
use App\Factories\PersonFactory;
use App\Factories\PhysicalPersonFactory;
use App\Factories\UserFactory;
use App\Models\LegalPerson;
use App\Models\Person;
use App\Models\PhysicalPerson;
use App\Models\User;
use App\Services\ServiceInterface;
use App\Utils\Mask;
use App\Utils\ResponseApi;
use App\Validate\Validate;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Class UserService
 * @package App\Services\V1
 */
abstract class UserService implements ServiceInterface
{
    /**
     * @param array $data
     * @return JsonResponse
     */
    public static function save(array $data): JsonResponse
    {
        DB::beginTransaction();
        try {
            $validate = Validate::cpfCnpj($data['id']);
            if (!$validate->isValid()) {
                $cpfCnpj = (strlen($data['id']) === 11) ? Mask::mask( '###.###.###-##', $data['id']) : Mask::mask('##.###.###/####-##', $data['id']);
                throw new Exception("CPF/CNPJ: ${cpfCnpj} inválido.", Response::HTTP_BAD_REQUEST);
            }

            $person = Person::find($validate->getValue());
            if ($person) {
                $cpfCnpj = (strlen($data['id']) === 11) ? Mask::mask( '###.###.###-##', $data['id']) : Mask::mask('##.###.###/####-##', $data['id']);
                throw new Exception("CPF/CNPJ: ${cpfCnpj} já existe.", Response::HTTP_BAD_REQUEST);
            }
            $person = PersonFactory::build();
            $person->person_id = $data['id'];
            $person->name = $data['name'];
            $person->save();

            if (strlen($person->person_id) === 11) {
                $physicalPerson = PhysicalPersonFactory::build();
                $physicalPerson->person_id = $person->person_id;
                $physicalPerson->birth_date = $data['birth_date'];
                $physicalPerson->save();
            } elseif (strlen($person->person_id) === 14) {
                $legalPerson = LegalPersonFactory::build();
                $legalPerson->person_id = $person->person_id;
                $legalPerson->company_name = $data['company_name'];
                $legalPerson->save();
            }

            $user = User::where('email', $data['email'])->first();
            if ($user) {
                throw new Exception("Email ${data['email']} já existe.", Response::HTTP_BAD_REQUEST);
            }
            $user = UserFactory::build();
            $user->person_id = $person->person_id;
            $user->email = $data['email'];
            $user->password = encrypt($data['password']);
            $user->save();

            DB::commit();
            return ResponseApi::success('usuário criando com sucesso!', true);
        } catch (Throwable $e) {
            DB::rollBack();
            if ($e->getCode() === Response::HTTP_BAD_REQUEST) {
                return ResponseApi::warning($e->getMessage(), false);
            }
            return ResponseApi::error($e->getMessage(), ' file: ' . $e->getFile() . ' line: ' . $e->getLine());
        }
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public static function update(array $data): JsonResponse
    {
        DB::beginTransaction();
        try {
            $validate = Validate::cpfCnpj($data['id']);
            if (!$validate->isValid()) {
                $cpfCnpj = (strlen($data['id']) === 11) ? Mask::mask( '###.###.###-##', $data['id']) : Mask::mask('##.###.###/####-##', $data['id']);
                throw new Exception("CPF/CNPJ: ${cpfCnpj} inválido.", Response::HTTP_BAD_REQUEST);
            }

            /** @var Person $person */
            $person = Person::find($validate->getValue());
            if (!$person) {
                throw new Exception("Pessoa não existe.", Response::HTTP_NOT_FOUND);
            }

            $person->name = $data['name'];
            $person->update();

            if (strlen($person->person_id) === 11) {
                /** @var PhysicalPerson $physicalPerson */
                $physicalPerson = PhysicalPerson::find($person->person_id);
                $physicalPerson->birth_date = $data['birth_date'];
                $physicalPerson->update();
            } elseif (strlen($person->person_id) === 14) {
                /** @var LegalPerson $legalPerson */
                $legalPerson = PhysicalPerson::find($person->person_id);
                $legalPerson->company_name = $data['company_name'];
                $legalPerson->update();
            }

            /** @var User $user */
            $user = User::find($person->person_id);

            /** @var User $userExist */
            $userExist = User::where('email', $data['email'])->first();
            if ($userExist && $user->email !== $userExist->email) {
                throw new Exception("Email ${data['email']} já existe.", Response::HTTP_BAD_REQUEST);
            }
            $user->email = $data['email'];
            $user->update();

            DB::commit();
            return ResponseApi::success('Dados alterado com sucesso!', true);
        } catch (Throwable $e) {
            DB::rollBack();
            if ($e->getCode() === Response::HTTP_BAD_REQUEST) {
                return ResponseApi::warning($e->getMessage(), false);
            }
            return ResponseApi::error($e->getMessage(), ' file: ' . $e->getFile() . ' line: ' . $e->getLine());
        }
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public static function delete(string $id): JsonResponse
    {
        try {
            /** @var User $user */
            $user = User::where('person_id', $id)->first();
            $user->delete();

            /** @var PhysicalPerson $physicalPerson */
            $physicalPerson = PhysicalPerson::where('person_id', $id)->first();
            $physicalPerson->delete();

            /** @var Person $person */
            $person = Person::where('person_id', $id)->first();
            $person->delete();

            return ResponseApi::success('Usuário excluido com sucesso!', true);
        } catch (Throwable $e) {
            return ResponseApi::error($e->getMessage(), ' file: ' . $e->getFile() . ' line: ' . $e->getLine() . ' ', $e->getCode());
        }
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public static function findById(string $id): JsonResponse
    {
        try {
            /** @var Person $person */
            $person = Person::where('person_id', $id)->first();
            /** @var PhysicalPerson $physicalPerson */
            $physicalPerson = PhysicalPerson::where('person_id', $id)->first();
            /** @var User $user */
            $user = User::where('person_id', $id)->first();
            $data = [
                'CPF/CNPJ' => Mask::mask('###.###.###-##', $person->person_id),
                'name' => $person->name,
                'birth_date' => Carbon::parse($physicalPerson->birth_date)->format('d/m/Y H:i:s'),
                'email' => $user->email
            ];
            return ResponseApi::success('Detalhes do usuário', $data);
        } catch (Throwable $e) {
            return ResponseApi::error($e->getMessage(), ' file: ' . $e->getFile() . ' line: ' . $e->getLine() . ' ', $e->getCode());
        }
    }

    /**
     * @return JsonResponse
     */
    public static function all(): JsonResponse
    {
        try {
            $users = DB::table('v1.users AS u')
                ->select('p.person_id', 'p.name', 'u.email', 'p_p.birth_date')
                ->join('v1.people AS p', 'u.person_id', '=', 'p.person_id')
                ->join('v1.physical_people AS p_p', 'p.person_id', '=', 'p_p.person_id')
                ->get()
            ;

            return ResponseApi::success('Lista de usuarios', $users);
        } catch (Throwable $e) {
            return ResponseApi::error($e->getMessage(), ' file: ' . $e->getFile() . ' line: ' . $e->getLine() . ' ', $e->getCode());
        }
    }
}
