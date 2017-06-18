<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MemberDataTable;
use App\Http\Requests\MemberShipRequest;
use App\Models\MemberShip;
use App\Models\Group;
use App\Models\MemberRole;
use Validator;

class MemberController extends Controller
{
    public function index(MemberDataTable $dataTable) 
    {
        return $dataTable->render('members.index');
    }

    public function create() 
    {
        $groups = Group::all();
        $member_roles = MemberRole::all();

        return view('members.create', compact('groups', 'member_roles'));
    }

    public function store(MemberShipRequest $request) 
    {
        $member = MemberShip::select('id_member')->orderby('created_at', 'desc')->first();
        //generate code
        $code = 'M-0000';
        if (empty($member->id_member)) 
        {
            $generate_code = 'M-00001';
        } else 
        {
            $explode = explode("-", $member->id_member);
            $increments_number = (int)$explode[1] + 1;
            $generate_code = $code.$increments_number;
        }

        $request->merge([
            'id_member' => $generate_code,
            'savings' => $request->savings ? $request->savings : 0,
            'salary' => $request->salary ? $request->salary : 0,
            'max_plafond_debiting' => $request->max_plafond_debiting ? $request->max_plafond_debiting : 0,
        ]);

        //save member
        $member = MemberShip::create($request->all());

        $request->session()->flash('context', 'success');
        $request->session()->flash('message', 'Data baru telah ditambahkan');
        // flash('Data member baru telah ditambahkan')->success();

        return redirect()->route('member.index');
    }

    public function show($id)
    {
        $member = MemberShip::with('group')->with('role')->find($id);
        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = MemberShip::find($id);
        $groups = Group::all();
        $member_roles = MemberRole::all();

        return view('members.edit', compact('groups', 'member_roles', 'member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'nik' => 'required|max:16',
            'group_id' => 'required|numeric',
            'member_role_id' => 'required|numeric', 
            'gender' => 'required|in:laki-laki,perempuan', 
            'date_of_birth' => 'required|date|date_format:Y-m-d', 
            'blood_type' => 'required|in:A,AB,B,O', 
            'religion' => 'required|in:islam,protestan,katolik,hindu,budha,kepercayaan', 
            'address' => 'required|max:255', 
            'phone' => 'required|numeric|digits_between:11,12',
            'savings' => 'digits_between:1,12|numeric',
            'salary' => 'digits_between:1,12|numeric',
            'max_plafond_debiting' => 'regex:/^\d{1,13}(\.\d{1,2})?$/'
        ]);

        if ($validator->fails()) {
            return redirect('member/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $member = MemberShip::select('email', 'phone')->where('id', $id)->first();

        if ($request->email !== $member->email) {
            $members = MemberShip::select('email')->where('email', $request->email)->first();
            if ($members) {
                return redirect('member/'.$id.'/edit')
                        ->withErrors(['email' => 'the email is already taken from another user'])
                        ->withInput();
            }
        }

        if ($request->phone !== $member->phone) {
            $members = MemberShip::select('phone')->where('phone', $request->phone)->first();
            if ($members) {
                return redirect('member/'.$id.'/edit')
                        ->withErrors(['phone' => 'phone is already taken with another user'])
                        ->withInput();
            }
        }

        $request->merge([
            'savings' => $request->savings ? $request->savings : 0,
            'salary' => $request->salary ? $request->salary : 0,
            'max_plafond_debiting' => $request->max_plafond_debiting ? $request->max_plafond_debiting : 0,
        ]);

        $member = MemberShip::find($id)->update($request->all());

        $request->session()->flash('context', 'success');
        $request->session()->flash('message', 'Data telah diupdate');
        // flash('Data telah diupdate')->success();
        
        return redirect()->route('member.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = MemberShip::find($id)->delete();

        flash ('Data berhasil dihapus')->success();
        
        return redirect()->route('member.index');
    }

    public function getData($id)
    {
        $member = MemberShip::select('blood_type', 'religion', 'group_id', 'member_role_id')->where('id', $id)->first();

        return $member;
    }

    public function getGroup()
    {
        $groups = Group::all();

        return $groups;
    }

    public function getMemberRole()
    {
        $member_role = MemberRole::all();

        return $member_role;
    }
}
