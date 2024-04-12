<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddActionRequest;
use App\Http\Requests\AddNewRoleRequest;
use App\Http\Requests\AddRoleTooUserRequest;
use App\Http\Requests\DeleteActionRequest;
use App\Http\Requests\UpdatePermissionsRequest;
use App\Http\Requests\UserActionRequest;
use App\Interfaces\UserRepository;
use App\UseCases\ActionsAction;
use App\UseCases\PermissionsAction;
use App\UseCases\RolesAction;
use App\UseCases\RoleUserAction;
use App\UseCases\UserAction;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getUsersList(): JsonResponse
    {
        try {
            $repository = app(UserRepository::class);
            return response()->json($repository->getAllUsers(), 200, [], 256);
        } catch (Exception $exception) {
            return response()->json(["message" => $exception->getMessage()], 422);
        }
    }

    public function getRoles(): JsonResponse
    {
        try {
            return response()->json(RolesAction::getAllRoles(), 200, [], 256);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 422);
        }
    }

    public function removeUserRole(Request $request): JsonResponse
    {
        try {
            RoleUserAction::removeUserRole($request->get('user_id'), $request->get('role_id'));
            return response()->json(null, 204, [], 256);
        } catch (Exception $exception) {
            return response()->json(["message" => $exception->getMessage()], 422);
        }
    }

    public function dropUserPassword(UserActionRequest $request): JsonResponse
    {
        try {
            return response()->json(UserAction::dropUserPassword($request->get('id')), 200, [], 256);
        } catch (Exception $exception) {
            return response()->json(null, 422, $exception->getMessage());
        }
    }

    public function deleteUser(UserActionRequest $request)
    {
        try {
            return response()->json(UserAction::deleteUser($request->get('id')), 204, [], 256);
        } catch (Exception $exception) {
            return response()->json(null, 422, $exception->getMessage());
        }
    }

    public function addUserRole(AddRoleTooUserRequest $request): JsonResponse
    {

        try {
            RoleUserAction::addUserRole($request->get('user_id'), $request->get('role_id'));
            return response()->json(null, 201, [], 256);
        } catch (Exception $exception) {
            return response()->json(null, 422, $exception->getMessage());
        }
    }

    public function newRoleAdd(AddNewRoleRequest $request)
    {
        try {
            return response()->json(RolesAction::newRoleAdd($request->get('role')), 201, [], 256);
        } catch (Exception $exception) {
            return response()->json(null, 422, $exception->getMessage());
        }
    }

    public function deleteRole(Request $request)
    {
        try {
            return response()->json(RolesAction::deleteRole($request->get('id')), 200, [], 256);
        } catch (Exception $exception) {
            return response()->json(null, 422, $exception->getMessage());
        }
    }

    public function getPermissions(Request $request): JsonResponse
    {
        try {
            return response()->json(PermissionsAction::getPermissions((int)$request->get('role_id')), 200, [], 256);
        } catch (Exception $e) {
            return response()->json(null, 500, $e->getMessage());
        }
    }

    public function changePermissions(UpdatePermissionsRequest $request): JsonResponse
    {
        try {
            PermissionsAction::changePermissions($request->get('action_id'), $request->get('role_id'), $request->get('granted'));
            return response()->json(null, 200, [], 256);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function deleteAction(DeleteActionRequest $request): JsonResponse
    {
        try {
            ActionsAction::deleteAction($request->get('id'));
            return $this->getActions();
        } catch (Exception $e) {
            return response()->json(null, 500, $e->getMessage());
        }
    }

    public function getActions()
    {
        try {
            return response()->json(ActionsAction::getActions(), 200, [], 256);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function addAction(AddActionRequest $request)
    {
        try {
            ActionsAction::addAction($request->get('action'));
            return $this->getActions();
        } catch (Exception $e) {
            return response()->json(null, 500, $e->getMessage());
        }
    }
}
