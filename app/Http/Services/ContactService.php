<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\Contact\ContactRepository;

/**
 * Class ContactService.
 *
 * @package namespace App\Http\Services;
 */
class ContactService
{
    /**
     * @var ContactRepository
     */
    protected $repository;

    /**
     * ContactService constructor.
     *
     * @param ContactRepository $repository
     */
    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Cria um contado do usuário
     *
     * @param string $name
     * @param string $email
     * @param string $phone
     * @param int $userId
     *
     * @return array
     */
    public function store(string $name, string $email, string $phone, int $userId)
    {
        DB::beginTransaction();
        try {
            $this->repository->create([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'user_id' => $userId
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            logger($th);
            return [
                'success' => false,
                'message' => 'Erro ao criar contato'
            ];
        }

        DB::commit();
        return [
            'success' => true,
            'message' => 'Contato criado com sucesso'
        ];
    }

    /**
     * Edita um contado do usuário
     *
     * @param int $id
     * @param string $name
     * @param string $email
     * @param string $phone
     * @param int $userId
     *
     * @return array
     */
    public function update(int $id, string $name, string $email, string $phone, int $userId)
    {
        DB::beginTransaction();
        try {
            $contact = $this->repository->find($id);

            // Validar se contrato é do usuário
            if (is_null($contact) || $contact->user_id !== $userId) {
                DB::rollback();
                return [
                    'success' => false,
                    'message' => 'Contato não encontrado'
                ];
            }

            $contact->update([
                'name' => $name,
                'email' => $email,
                'phone' => $phone
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            logger($th);
            return [
                'success' => false,
                'message' => 'Erro ao editar contato'
            ];
        }

        DB::commit();
        return [
            'success' => true,
            'message' => 'Contato editado com sucesso'
        ];
    }

    /**
     * Deleta um contado do usuário
     *
     * @param int $id
     * @param int $userId
     *
     * @return array
     */
    public function destroy(int $id, int $userId)
    {
        DB::beginTransaction();
        try {
            $contact = $this->repository->find($id);

            // Validar se contrato é do usuário
            if (is_null($contact) || $contact->user_id !== $userId) {
                DB::rollback();
                return [
                    'success' => false,
                    'message' => 'Contato não encontrado'
                ];
            }

            $contact->delete();
        } catch (\Throwable $th) {
            DB::rollback();
            logger($th);
            return [
                'success' => false,
                'message' => 'Erro ao deletar contato'
            ];
        }

        DB::commit();
        return [
            'success' => true,
            'message' => 'Contato deletado com sucesso'
        ];
    }
}
