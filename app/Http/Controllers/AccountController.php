<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::latest()->paginate(5);

        return view('accounts.index',compact('accounts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'start_balance' => 'required',
            'current_balance' => 'required',
        ]);

        $account = new Account($request->all());
        $account->user_id = Auth::user()->id;
        $account->save();

        return redirect()->route('accounts.index')
            ->with('success','Account created successfully.');
    }

    /**
     * Display the specified resource.
     * @param  int  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        return view('accounts.show',compact('account'));
    }

    /**
     * Display the specified resource.
     * @param  int  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        return view('accounts.edit',compact('account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'start_balance' => 'required',
            'current_balance' => 'required',
        ]);

        Account::update($request->all());

        return redirect()->route('accounts.index')
            ->with('success','Account updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        $account->delete();

        return redirect()->route('accounts.index')
            ->with('success','Account deleted successfully');
    }
}
