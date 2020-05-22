<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperationsRequest;
use App\Operation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OperationController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $operations = Operation::whereNotIn('status', [0])->orderBy('id', 'desc')->orderBy('date', 'desc')->get();
    $debe = Operation::where('type', 0)->where('status', 1)->sum('mount');
    $haber = Operation::where('type', 1)->where('status', 1)->sum('mount');
    $saldo = $haber - $debe;

    $lastPay = $operations->where('type', 1)->where('status', 1)->first();

    $daysLastPay = $lastPay ? Carbon::now()->diffInDays($lastPay->date) : 0;

    return view('operations.index', compact(['operations', 'debe', 'haber', 'saldo', 'daysLastPay', 'lastPay']));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('operations.form');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(OperationsRequest $request)
  {
    Operation::create([
      'description' => $request->description,
      'mount' => $request->mount,
      'date' => is_null($request->date) ? Carbon::now() : $request->date,
      'type' => $request->type,
    ]);

    return redirect()->route('operations.index')->withSuccess('Se ha guardado el registro');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Operation  $operation
   * @return \Illuminate\Http\Response
   */
  public function show(Operation $operation)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Operation  $operation
   * @return \Illuminate\Http\Response
   */
  public function edit(Operation $operation)
  {
    return view('operations.form', compact(['operation']));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Operation  $operation
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Operation $operation)
  {
    $data = $request->all();
    $data['status'] = 1;
    $operation->update($data);
    return redirect()->route('operations.index')->withSuccess('Operación actualizada');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Operation  $operation
   * @return \Illuminate\Http\Response
   */
  public function destroy(Operation $operation)
  {
    if($operation->status === 2){
      $operation->update(['status' => 0]);
      $msg = 'Registro borrado correctamente';
    }else{
      $operation->update(['status' => 2]);
      $msg = 'Registro anulado correctamente';
    }
    return redirect()->route('operations.index')->withSuccess($msg);
  }
}
