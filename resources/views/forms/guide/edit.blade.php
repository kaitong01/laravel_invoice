<?php

$Fn = new Fn;

// image
// $imageCoverOpt = [
//     'name'           => 'file1',
//     'width'          => 150,
//     'height'         => 150,

//     'dropzoneText' => 'รูป',

//     'cancelFileName' => 'avatar_cancel_file'
// ];

if( !empty($data) ){
    $formAction = '/api/v1/guide/'.$data->invoiceid;
    // if(!empty($data->avatar_url)){
    //    $imageCoverOpt['src'] = $data->avatar_url;
    // }

    $arr['hiddenInput'][] = array('name'=>'id', 'value'=>$data->invoiceid);
    $arr['hiddenInput'][] = array('name'=>'_method', 'value'=>'PUT');

    $arr['title'] = 'แก้ไขประเภทการโอนเงิน';
    $arr['title'] .= '<div class="fsm text-muted" style="font-size:13px">แก้ไขล่าสุด: '.$Fn->q('time')->live( $data->updated_at ).'</div>';
}
// else{
//     $formAction = '/api/v1/guide/';
//     $arr['hiddenInput'][] = array('name'=>'_method', 'value'=>'POST');
//     $arr['title'] = 'สร้างรายชื่อติดต่อใหม่';
// }

$arr['hiddenInput'][] = array('name'=>'_token', 'value'=>csrf_token());


$form = new Form();
$formBox = $form->create()
    // set From
    ->elem('div')
    ->addClass('form-insert')
    ->style('horizontal')

   // ->field($imageCoverOpt['name'])
   //      ->label('รูป')
   //      ->text( '<div style="width: 150px">'.$Fn->q('form')->imageCover( $imageCoverOpt ).'</div>' )
    ->field("invoiceid")
        ->label( 'เลขที่' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->value( !empty($data->invoiceid)? $data->invoiceid:'' )
->field("invoicetype")
        ->label( 'ประเภทการโอนเงิน' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->value( !empty($data->invoicetype)? $data->invoicetype:'' )
->field("invoiceuserid")
        ->label( 'รหัสผู้ใช้' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->value( !empty($data->invoiceuserid)? $data->invoiceuserid:'' )

->field("invoiceusername")
        ->label( 'ชื่อผู้ใช้' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->value( !empty($data->invoiceusername)? $data->invoiceusername:'' )

->field("invoicebankid")
        ->label( 'เลขบัญชี' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->value( !empty($data->invoicebankid)? $data->invoicebankid:'' )

->field("invoicebank")
        ->label( 'ธนาคาร' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->value( !empty($data->invoicebank)? $data->invoicebank:'' )

->field("invoicelist")
        ->label( 'รายการ' )
        // ->select()
        ->autocomplete('off')
        ->addClass('form-control')
        ->value( !empty($data->invoicelist)? $data->invoicelist:'' )


 ->field("invoiceprice")
        ->label( 'ราคา' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->maxlength(175)
        ->attr('aria-label', 'required')
        ->value( !empty($data->invoiceprice)? $data->invoiceprice:'' )

//  ->field("company")
//         ->label( 'บริษัท' )
//         ->autocomplete('off')
//         ->addClass('form-control')
//         ->maxlength(175)
//         ->value( !empty($data->company)? $data->company:'' )

// ->field("job")
//         ->label( 'ตำแหน่งงาน' )
//         ->autocomplete('off')
//         ->addClass('form-control')
//         ->maxlength(175)
//         ->value( !empty($data->job)? $data->job:'' )

//  ->field("email")
//         ->label( 'อีเมล' )
//         ->autocomplete('off')
//         ->addClass('form-control')
//         ->value( !empty($data->email)? $data->email:'' )

//  ->field("phone_number")
//         ->label( 'โทรศัพท์' )
//         ->autocomplete('off')
//         ->addClass('form-control')
//         ->value( !empty($data->phone_number)? $data->phone_number:'' )

//  ->field("line")
//         ->label( 'ไลน์' )
//         ->autocomplete('off')
//         ->addClass('form-control')
//         ->value( !empty($data->line)? $data->line:'' )



// ->field("remarks")
//         ->type( 'textarea' )
//         ->label( 'หมายเหตุ' )
//         ->autocomplete('off')
//         ->addClass('form-control')
//         ->attr('data-plugin', 'autosize')
//         ->value( !empty($data->remarks)? $data->remarks:'' )
->html();


# body
$arr['body'] = $formBox;
$arr['form'] = '<form method="post" action="'.asset( $formAction ).'" data-plugin="formSubmit"></form>';

# fotter: buttons
$arr['button'] = '<button type="submit" class="btn btn-primary btn-submit ml-2"><span class="btn-text">บันทึก</span></button>';

$arr['width'] = 800;


http_response_code(200);
echo json_encode($arr);
