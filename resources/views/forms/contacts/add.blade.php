<?php

$Fn = new Fn;

// image
$imageCoverOpt = [
    'name'           => 'file1',
    'width'          => 150,
    'height'         => 150,

    'dropzoneText' => 'รูป',

    'cancelFileName' => 'avatar_cancel_file'
];

if( !empty($data) ){
    $formAction = '/api/v1/contacts/'.$data->id;
    if(!empty($data->avatar_url)){
       $imageCoverOpt['src'] = $data->avatar_url;
    }

    $arr['hiddenInput'][] = array('name'=>'id', 'value'=>$data->id);
    $arr['hiddenInput'][] = array('name'=>'_method', 'value'=>'PUT');

    $arr['title'] = 'แก้ไขรายชื่อติดต่อ';
    $arr['title'] .= '<div class="fsm text-muted" style="font-size:13px">แก้ไขล่าสุด: '.$Fn->q('time')->live( $data->updated_at ).'</div>';
}
else{
    $formAction = '/api/v1/contacts/';
    $arr['hiddenInput'][] = array('name'=>'_method', 'value'=>'POST');
    $arr['title'] = 'สร้างรายชื่อติดต่อใหม่';
}

$arr['hiddenInput'][] = array('name'=>'_token', 'value'=>csrf_token());


$form = new Form();
$formBox = $form->create()
    // set From
    ->elem('div')
    ->addClass('form-insert')
    ->style('horizontal')

   ->field($imageCoverOpt['name'])
        ->label('รูป')
        ->text( '<div style="width: 150px">'.$Fn->q('form')->imageCover( $imageCoverOpt ).'</div>' )
->field("username")
        ->label( 'ชื่อผู้ใช้' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->value( !empty($data->username)? $data->username:'' )
->field("password")
        ->label( 'รหัสผ่าน' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->value( !empty($data->password)? $data->password:'' )

->field("bankid")
        ->label( 'เลขบัญชี' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->value( !empty($data->bankid)? $data->bankid:'' )

->field("bank")
        ->label( 'ธนาคาร' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->value( !empty($data->bank)? $data->bank:'' )

->field("personalid")
        ->label( 'เลขบัตรประชาชน' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->value( !empty($data->personalid)? $data->personalid:'' )

->field("typemonney")
        ->label( 'ประเภทการโอนเงิน' )
        // ->select()
        ->autocomplete('off')
        ->addClass('form-control')
        ->value( !empty($data->typemonney)? $data->typemonney:'' )


 ->field("name")
        ->label( 'ชื่อ*' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->maxlength(175)
        ->attr('aria-label', 'required')
        ->value( !empty($data->name)? $data->name:'' )

 ->field("company")
        ->label( 'บริษัท' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->maxlength(175)
        ->value( !empty($data->company)? $data->company:'' )

->field("job")
        ->label( 'ตำแหน่งงาน' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->maxlength(175)
        ->value( !empty($data->job)? $data->job:'' )

 ->field("email")
        ->label( 'อีเมล' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->value( !empty($data->email)? $data->email:'' )

 ->field("phone_number")
        ->label( 'โทรศัพท์' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->value( !empty($data->phone_number)? $data->phone_number:'' )

 ->field("line")
        ->label( 'ไลน์' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->value( !empty($data->line)? $data->line:'' )



->field("remarks")
        ->type( 'textarea' )
        ->label( 'หมายเหตุ' )
        ->autocomplete('off')
        ->addClass('form-control')
        ->attr('data-plugin', 'autosize')
        ->value( !empty($data->remarks)? $data->remarks:'' )
->html();


# body
$arr['body'] = $formBox;
$arr['form'] = '<form method="post" action="'.asset( $formAction ).'" data-plugin="formSubmit"></form>';

# fotter: buttons
$arr['button'] = '<button type="submit" class="btn btn-primary btn-submit ml-2"><span class="btn-text">บันทึก</span></button>';

$arr['width'] = 800;


http_response_code(200);
echo json_encode($arr);
