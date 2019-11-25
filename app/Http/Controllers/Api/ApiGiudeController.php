<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\guide AS IDB;

class ApiGiudeController extends Controller
{
    protected $cValidator = [
        // 'name' => 'required|max:75',

        // 'file1' => 'mimes:jpeg,jpg,png|max:1000',
    ];

    protected $cValidatorMsg = [
        // 'name.required' => 'กรุณากรอกชื่อ',

        // 'description.required' => 'กรุณากรอกคำอธิบาย',

        // 'logo.required' => 'กรุณาใส่รูปภาพ',
        // 'file1.mimes' => 'ชนิดของไฟล์ต้องเป็น .jpeg, .jpg, .png เท่านั้น',
        // 'file1.max' => 'รับขนาดไฟล์สูงสุดที่จะอัปโหลดคือ 2MB',
    ];

    // get data all 
    public function index(IDB $db, Request $request)
    {
        $res = $db->find($request);
        $res['items'] = $this->ui->item('invoicelist')->init($res['data'], $res['options']);

        $res['code'] = 200;
        $res['info'] = 'Contacts results successfully';
        $res['message'] = 'The request has succeeded.';
        
        return response()
            ->json($res, 200)
            ->header('Content-Type', 'application/json');
    }

    
    // insert data
    public function store(Request $request)
    {
        $arr = [];
        $validator = Validator::make($request->all(), $this->cValidator, $this->cValidatorMsg);

        if ( $validator->fails() ) {
            $arr['code'] = 422;
            $arr['errors'] = $validator->errors();
        }
        else{

            $data = new IDB;
            if( $data->fill( Input::all() )->save() ){

                // upload image

                // if($request->has('file1')){
                //     $data->avatar = $request->file('file1')->store('avatar', 'public');
                //     $data->update();
                // }

                $arr['code'] = 200;
                $arr['info'] = 'The request has succeeded.';
                $arr['message'] = 'บันทึกข้อมูลเรียบร้อย';

                $arr['call'] = 'refreshDatatable';
            }
            else{
                $arr['code'] = 422;
                $arr['message'] = 'บันทึกข้อมูลล้มเหล่ว, กรุณาลองใหม่';
            }
        }

        return response()
            ->json($arr, $arr['code'])
            ->header('Content-Type', 'application/json');
    }

    // update data
    public function update(IDB $db, Request $request, $id)
    {
        $data = IDB::findOrFail($id);

        if( is_null( $data ) ){
            return response()->json(["message" => 'Record not found!'], 404);
        }

        $arr = [];
        $validator = Validator::make($request->all(), $this->cValidator, $this->cValidatorMsg);

        if( $validator->fails() ){
            $arr['code'] = 422;
            $arr['errors'] = $validator->errors();
        }
        else{


            // ลบรูปเดิม
            // if(!empty($data->avatar) && ($request->has('file1') || $request->has('avatar_cancel_file')) ){
            //     Storage::disk('public')->delete($data->avatar);
            //     $data->avatar = null;
            // }

            if( $data->fill( Input::all() )->update() ){

                // if($request->has('file1')){

                //     // เพิ่มรูปใหม่
                //     $data->avatar = $request->file('file1')->store('avatar', 'public' );
                    // $data->update();
                // }


                $arr['code'] = 200;
                $arr['info'] = 'The request has succeeded.';
                $arr['message'] = 'บันทึกข้อมูลเรียบร้อย';

                // callback update
                $arr['update'] = ['[contact-id='.$id.']', $db->convert($data)];
            }
            else{
                $arr['code'] = 422;
                $arr['message'] = 'บันทึกข้อมูลล้มเหล่ว, กรุณาลองใหม่';
            }
        }

        return response()
            ->json($arr, $arr['code'])
            ->header('Content-Type', 'application/json');
    }

    // delete data
    public function destroy($id)
    {
        $data = IDB::findOrFail($id);

        if( is_null( $data ) ){
            return response()->json(["message" => 'Record not found!'], 404);
        }

        
        // ลบรูป
        if( !empty($data->avatar) ){
            Storage::disk('public')->delete($data->avatar);
        }


        // ลบข้อมูล
        $data->delete();

        return response()
            ->json([
                'code' => 200,
                'info' => 'The request has succeeded.',
                "message" => 'ลบข้อมูลเรียบร้อย',
    
                'call' => 'refreshDatatable',
            ], 200)
            ->header('Content-Type', 'application/json');
    }
}
