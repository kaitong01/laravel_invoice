<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact AS MDB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;
// 
// use Illuminate\Support\Facades\Storage;

class ApiContactController extends Controller
{

    protected $cValidator = [
        'name' => 'required|max:75',

        'file1' => 'mimes:jpeg,jpg,png | max:1000',
    ];

    protected $cValidatorMsg = [
        'name.required' => 'กรุณากรอกชื่อ',

        // 'description.required' => 'กรุณากรอกคำอธิบาย',

        // 'logo.required' => 'กรุณาใส่รูปภาพ',
        'file1.mimes' => 'ชนิดของไฟล์ต้องเป็น .jpeg, .jpg, .png เท่านั้น',
        'file1.max' => 'รับขนาดไฟล์สูงสุดที่จะอัปโหลดคือ 2MB',
    ];

    // get data all 
    public function index(MDB $db, Request $request)
    {
        $res = $db->find($request);


        $res['items'] = $this->ui->item('ContactsDataTables')->init($res['data'], $res['options']);

        $arr['code'] = 200;
        $arr['info'] = 'Contacts results successfully';
        $arr['message'] = 'The request has succeeded.';

        // $data = [];
        return response()
            ->json(array_merge($arr, $res), 200)
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

            $data = new MDB;
            if( $data->fill( Input::all() )->save() ){

                // upload image

            //     if($request->has('file1')){

            //         // $data = Wholesale::find( $id );
            //         $data->logo = $request->file('logo')->store('uploads', 'public' );
            //         // $data->logo = Storage::putFile('uploads', $request->file('logo'));
            //         $data->update();
            //     }

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
    public function update(Request $request, $id)
    {
        $data = MDB::findOrFail($id);

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

            if( $data->fill( Input::all() )->update() ){

                $arr['code'] = 200;
                $arr['info'] = 'The request has succeeded.';
                $arr['message'] = 'บันทึกข้อมูลเรียบร้อย';
            }
            else{
                $arr['code'] = 422;
                $arr['message'] = 'บันทึกข้อมูลล้มเหล่ว, กรุณาลองใหม่';
            }
        }
       

        //     // $folder_path =
        //     if(!empty($data->logo) && ($request->has('logo') || $request->_logo) ){

        //         Storage::disk('public')->delete($data->logo);
        //         $data->logo = '';
        //     }

        //     if($request->has('logo')){
        //         // $data->logo = Storage::putFile('uploads', $request->file('logo'));
        //         $data->logo = $request->file('logo')->store('uploads', 'public' );
        //     }

        //     if( $data->update() ){
        //         $arr['code'] = 200;
        //         $arr['message'] = 'บันทึกข้อมูลเรียบร้อย';


        //         if( !empty($data->logo) ){
        //             $data->logo_url = asset("storage/".$data->logo);
        //         }
        //         else{
        //             $data->logo_url = '';
        //         }

        //         $arr['update'] = ['[wholesale-id='.$id.']', $data];
        //     }
        //     else{
        //         $arr['code'] = 422;
        //         $arr['message'] = 'บันทึกข้อมูลล้มเหล่ว, กรุณาลองใหม่';
        //     }
        // }


        return response()
            ->json($arr, $arr['code'])
            ->header('Content-Type', 'application/json');
    }

    // delete data
    public function destroy($id)
    {
        $data = MDB::findOrFail($id);

        if( is_null( $data ) ){
            return response()->json(["message" => 'Record not found!'], 404);
        }

        // ลบรูป
        // if( !empty($data->image) ){
        //     Storage::disk('public')->delete($data->image);
        // }


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