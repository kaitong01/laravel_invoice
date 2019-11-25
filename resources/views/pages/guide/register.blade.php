<?php 
$form = new Form();
$formBox = $form->create()
    // set From
    ->elem('div')->addClass('form-insert')->style('horizontal')
->field("username")
        ->label( 'ชือผู้ใช้*' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->maxlength(175)
        ->value( !empty($data->job)? $data->job:'' )

 ->field("password")
        ->label( 'รหัสผ่าน*' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->maxlength(175)
        ->value( !empty($data->job)? $data->job:'' )    

->field("status")
        ->label( 'สถานะ*' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->maxlength(175)
        ->attr('aria-label', 'required')
        ->value( !empty($data->name)? $data->name:'' )

 ->field("name")
        ->label( 'ชื่อ*' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->maxlength(175)
        ->attr('aria-label', 'required')
        ->value( !empty($data->name)? $data->name:'' )

 ->field("moneytype")
        ->label( 'ประเภทการโอน' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->maxlength(175)
        ->value( !empty($data->company)? $data->company:'' )

->field("bankid")
        ->label( 'เลขบัญชี' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->maxlength(175)
        ->value( !empty($data->job)? $data->job:'' )


 ->field("bank")
        ->label( 'ธนาคาร' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->maxlength(175)
        ->value( !empty($data->job)? $data->job:'' )

 ->field("เpersonalid")
        ->label( 'เลขบัตรประชาชน' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->maxlength(175)
        ->value( !empty($data->job)? $data->job:'' )

    
        ->html();

?>        
@extends('layouts.admin')

@isset( $title )
@section('title', $title)
@endisset

@section('content')
<div class="container">
    <div class="col-md-10">

        <div class="card mt-5">
  <div class="card-header" style="font-weight: bold; font-size: 20px;">
     สมัครสมาชิก
  </div>
  <div class="card-body">
    <p class="card-text">
        <form method="post" action="/api/v1/guide/invoice" class="container mt-5" data-plugin="GuideInvoiceForm">
        @csrf
        <?=$formBox?>


        <table>
            <tr>
                <td></td>
                <td colspan="2"></td>
                
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>

                <td></td>
            </tr>
        <table>
    </form></p><br>
    <div class="text_center" align="center"> <a href="#" class="btn btn-primary" style="width: 100px;">ยืนยัน</a> <a href="/invoice" class="btn btn-danger" style="width: 100px;">ยกเลิก</a></div>

   
  </div>
</div>
    </div>
</div>
    
@endsection