<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\education;
use App\Models\user_education;
use App\Models\user_achievements;
use App\Models\user_experience;

class ProfileController extends Controller
{
    public function index(){
    	$data['user'] = Auth::user();
    	$data['profile'] = 1;
        $data['education'] = education::all();
        $data['user_education'] = education::join('user_educations', 'education_id', '=', 'educations.id')
        ->where('user_id', Auth::user()->id)
        ->orderBy('education_id', 'asc')
        ->get();
    	return view('system.users.profile', $data);
    }

    public function set_education(Request $request){
        $request->validate([
          'user_id' => 'required|exists:users,id',
          'education_id' => 'required|exists:educations,id',
          'institution' => 'required',
          'from_year' => 'required',
          'to_year' => 'required'
        ]);

        $user_education = new user_education();
        $user_education->user_id = $request->user_id;
        $user_education->education_id = $request->education_id;
        $user_education->institution = $request->institution;
        $user_education->from_year = $request->from_year;
        $user_education->to_year = $request->to_year;
        $user_education->save();

        return redirect(route('account.profile'))->with('message', [
          'class' => 'success',
          'text' => 'Berhasil menambah riwayat pendidikan'
        ]);
    }

    public function update_education(Request $request){
        // dd($request->all());
        $validatedInput = $request->validate([
          'user_education_id' => 'required',
          'education_id' => 'required',
          'institution' => 'required',
          'from_year' => 'required',
          'to_year' => 'required'
        ]);

        $education = user_education::find($request->user_education_id);

        $education->education_id = $request->education_id;
        $education->institution = $request->institution;
        $education->from_year = $request->from_year;
        $education->to_year = $request->to_year;
        $education->update();

        return redirect(route('account.profile'))->with('message', [
          'class' => 'success',
          'text' => 'Berhasil mengubah riwayat pendidikan'
        ]);
    }

    public function delete_education(Request $request){
        // dd($request->all());
        $validatedInput = $request->validate([
          'user_id' => 'required',
          'user_education_id' => 'required'
        ]);

        user_education::where('id', $validatedInput['user_education_id'])->where('user_id', $validatedInput['user_id'])->delete();

        return redirect(route('account.profile'))->with('message', [
          'class' => 'warning',
          'text' => 'Berhasil menghapus riwayat pendidikan'
        ]);
    }

    public function set_achievements(Request $request){
        // dd($request->all());
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'deskripsi' => 'required'
        ]);

        $pencapaian = new user_achievements();
        $pencapaian->description = $request->deskripsi;
        $pencapaian->user_id = $request->user_id;
        $pencapaian->save();

        return redirect(route('account.profile'))->with('message', [
          'class' => 'success',
          'text' => 'Berhasil menambahkan pencapaian'
        ]);
    }

    public function update_achievements(Request $request){
        // dd($request->all());
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'id_achievements' => 'required:exists:achievements,id',
            'deskripsi' => 'required'
        ]);

        $pencapaian = user_achievements::find($request->id_achievements);
        $pencapaian->description = $request->deskripsi;
        $pencapaian->update();

        return redirect(route('account.profile'))->with('message', [
          'class' => 'success',
          'text' => 'Berhasil mengubah pencapaian'
        ]);
    }

    public function delete_achievements(Request $request){
        // dd($request->all());
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'id_achievements' => 'required:exists:achievements,id',
        ]);

        user_achievements::where('id', $request->id_achievements)->where('user_id', $request->user_id)->delete();

        return redirect(route('account.profile'))->with('message', [
          'class' => 'warning',
          'text' => 'Berhasil menghapus pencapaian'
        ]);
    }

    public function set_experience(Request $request){
        // dd($request->all());
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'institution' => 'required',
            'position' => 'required'
        ]);

        $exp = new user_experience();
        $exp->user_id = $request->user_id;
        $exp->institution = $request->institution;
        $exp->position = $request->position;
        $exp->save();

        return redirect(route('account.profile'))->with('message', [
          'class' => 'success',
          'text' => 'Berhasil menambahkan pengalaman'
        ]);
    }

    public function update_experience(Request $request){
        // dd($request->all());
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'exp_id' => 'required|',
            'institution' => 'required',
            'position' => 'required'
        ]);

        $exp = user_experience::find($request->exp_id);
        $exp->institution = $request->institution;
        $exp->position = $request->position;
        $exp->update();

        return redirect(route('account.profile'))->with('message', [
          'class' => 'success',
          'text' => 'Berhasil mengubah pengalaman'
        ]);
    }

    public function delete_experience(Request $request){

    }
}
