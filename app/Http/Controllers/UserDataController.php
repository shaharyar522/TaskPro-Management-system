<?php

namespace App\Http\Controllers;

use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $userId = Auth::id();

        // ✅ Get first record, not collection
        $userData = UserData::where('user_id', $userId)->get();

        return view('user.dashboard', compact('userData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Validate the request (no return)
        $request->validate([
            'corp_id' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'billing_TN' => 'nullable|string|max:255',
            'order_number' => 'nullable|string|max:255',
            'install_T_T_Soc_TTC' => 'nullable|string|max:255',
            'ont_Ntd' => 'nullable|string|max:255',
            'comp_or_refer' => 'nullable|string|max:255',
            'billing_code' => 'nullable|string|max:255',
            'qty' => 'nullable|integer',
            'description' => 'nullable|string|max:255',
            'rate' => 'nullable|string|max:255',
            'total_billed' => 'nullable|string|max:255',
            'aerial_buried' => 'nullable|string|max:255',
            'fiber' => 'nullable|string|max:255',
            'closeout_notes' => 'nullable|string|max:255',
            'in' => 'nullable|string|max:255',
            'out' => 'nullable|string|max:255',
            'hours' => 'nullable|integer',
            'user_id' => 'required|exists:users,id',
        ]);
        // ✅ Check if user already has a record

        // ✅ Store using $request->all() or specific fields
        UserData::create([
            'corp_id' => $request->corp_id,
            'address' => $request->address,
            'billing_TN' => $request->billing_TN,
            'order_number' => $request->order_number,
            'install_T_T_Soc_TTC' => $request->install_T_T_Soc_TTC,
            'ont_Ntd' => $request->ont_Ntd,
            'comp_or_refer' => $request->comp_or_refer,
            'billing_code' => $request->billing_code,
            'qty' => $request->qty,
            'description' => $request->description,
            'rate' => $request->rate,
            'total_billed' => $request->total_billed,
            'aerial_buried' => $request->aerial_buried,
            'fiber' => $request->fiber,
            'closeout_notes' => $request->closeout_notes,
            'in' => $request->in,
            'out' => $request->out,
            'hours' => $request->hours,
            'user_id' => $request->user_id,
        ]);

        return redirect()->back()->with('success', 'Your data saved successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(UserData $userData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $userdata = UserData::findOrFail($id);
        return view('user.edit', compact('userdata'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // ✅ Validate the request (no return)
        $request->validate([
            'corp_id' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'billing_TN' => 'nullable|string|max:255',
            'order_number' => 'nullable|string|max:255',
            'install_T_T_Soc_TTC' => 'nullable|string|max:255',
            'ont_Ntd' => 'nullable|string|max:255',
            'comp_or_refer' => 'nullable|string|max:255',
            'billing_code' => 'nullable|string|max:255',
            'qty' => 'nullable|integer',
            'description' => 'nullable|string|max:255',
            'rate' => 'nullable|string|max:255',
            'total_billed' => 'nullable|string|max:255',
            'aerial_buried' => 'nullable|string|max:255',
            'fiber' => 'nullable|string|max:255',
            'closeout_notes' => 'nullable|string|max:255',
            'in' => 'nullable|string|max:255',
            'out' => 'nullable|string|max:255',
            'hours' => 'nullable|integer',
            'user_id' => 'required|exists:users,id',
        ]);


        $userData = UserData::findOrFail($id);


        // ✅ Store using $request->all() or specific fields
        $userData->update([
            'corp_id' => $request->corp_id,
            'address' => $request->address,
            'billing_TN' => $request->billing_TN,
            'order_number' => $request->order_number,
            'install_T_T_Soc_TTC' => $request->install_T_T_Soc_TTC,
            'ont_Ntd' => $request->ont_Ntd,
            'comp_or_refer' => $request->comp_or_refer,
            'billing_code' => $request->billing_code,
            'qty' => $request->qty,
            'description' => $request->description,
            'rate' => $request->rate,
            'total_billed' => $request->total_billed,
            'aerial_buried' => $request->aerial_buried,
            'fiber' => $request->fiber,
            'closeout_notes' => $request->closeout_notes,
            'in' => $request->in,
            'out' => $request->out,
            'hours' => $request->hours,
            'user_id' => $request->user_id,
        ]);


        return redirect()
            ->route('user.dashboard')
            ->with('redirect_to_report', true)
            ->with('success_type', 'Updated!')
            ->with('success', 'User data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
{
    $userData = UserData::findOrFail($id);
    $userData->delete();

    return redirect()
        ->route('user.dashboard')
        ->with('redirect_to_report', true)
        ->with('success_type', 'Deleted!')
        ->with('success', 'User record deleted successfully.');
}

}
