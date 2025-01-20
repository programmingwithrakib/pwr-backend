<?php

namespace App\Http\Controllers;

use App\Enums\ExportFormat;
use App\Enums\UserTypeEnum;
use App\Helper;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\Invoice\InvoiceCreateRequest;
use App\Http\Requests\Invoice\InvoiceUpdateRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\CompanySetting;
use App\Models\Hotel;
use App\Models\Invoice;
use App\Models\InvoiceData;
use App\Models\Order;
use App\Models\Role;
use App\Models\Scopes\AssignHotelScope;
use App\Models\User;
use App\Models\UserHotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{

    public function profilePage(){
        return view('users.profile');
    }

    public function updateProfile(UpdateProfileRequest $request){
        $user = auth()->user();
        $data = collect($request->validated())->except('file')->toArray();
        try {
            if ($request->file){
                $user->clearMediaCollection();
                $user->addMediaFromRequest('file')->toMediaCollection();
            }
            $user->update($data);
            return $this->successMessage(Helper::UpdatedSuccessFully());
        }
        catch (\Exception $exception){
            return $this->errorMessage($exception->getMessage());
        }
    }

    public function changePasswordPage(){
        return view('users.change_password');
    }
    public function changePassword(ChangePasswordRequest $request){
        if (Hash::check($request->old_password, auth()->user()->password)){
            $new_password = Hash::make($request->new_password);
            auth()->user()->update(['password' => $new_password]);
            return $this->successMessage("Updated Successfully");
        }
        else{
            return $this->errorMessage('Your current password is incorrect');
        }
    }



}
