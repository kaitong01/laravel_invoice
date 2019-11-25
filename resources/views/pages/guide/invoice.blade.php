
<?php 
$form = new Form();
$formBox = $form->create()

->html();

?>        
@extends('layouts.admin')

@isset( $title )
@section('title', $title)
@endisset

@section('content')
<div class="container" data-plugin="addinputtablr">
    <div class="col-md-10">

        <div class="card mt-5">
          <div class="card-header" style="font-weight: bold; font-size: 20px;">
           รายการใบสำคัญจ่าย
       </div>
       <div class="card-body">
        <p class="card-text">
          <div class="float-right" style="margin-right: 20px;" align=""> 
    <button class="btn btn-primary addform"><i class="fas fa-plus"></i> เพิ่มรายการ</button>  <button class="btn btn-danger delform"><i class="fas fa-trash-alt"></i> ลบรายการ</button>
</div>
            <form method="post" action="/api/v1/guide/invoice" class="container mt-5" >
                @csrf   
                <div>
                  <input type="hidden" class="form-control" name="invoiceuserid">
                  <input type="hidden" class="form-control" name="invoicetype" value="1" disabled>
        
               </div>
                <div class="" width="50px;">
                    <table class="table table-bordered   text-center">
                      <thead class="thead-dark ">
                        <tr>
                          <th scope="col">รายการ</th>
                          <th scope="col">จำนวนเงิน(บาท)</th>
                      </tr>
                  </thead>
                  <tbody>
                    <tr class="managetable" id="managetable">
                     <!--  <div class="list" id="div_1"> -->
                        
                      <td><input type="text" class="form-control" placeholder="รายการ" name="invoicelist" id="list"></td>
                      <td><input type="text" class="form-control price" placeholder="จำนวนเงิน" name="invoiceprice" id="price"></td>
                      <!-- <td class="tableform"></td> -->

                      <!-- </div> -->
                  </tr>
              </tbody>
          </table>
          <label class=""  style="font-weight: bold;">รวมเงิน</label>
          <div class="row" style="margin-top: 10px;">
            <div class="col-8">

               <input type="text" name="" class="form-control" placeholder="บาทถ้วน" id="invoicethaiprice" name="invoicethaiprice">
            </div>
            <div class="col-4">
               <input type="text" name="" class="form-control" name="invoiceprice" id="invoiceprice" placeholder="บาท">
            </div>
           
          </div>
          <!--   <?=$formBox?> -->
      </div><br>    
  </form></p>
  <div class="text_center" align="center"> 
    <a href="" class="btn btn-dark" style="width: 90px;">บันทึก</a>
</div>

</div>
</div>
</div>
</div>

@endsection

<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var count = 1;

        dynamic_field(count);

        function dynamic_field(number)
        {
            var html = '<tr>';
            html += '<td><input type="text" class="form-control" placeholder="รายการ" name="invoicelist" ></td>';
            html += ' <td><input type="text" class="form-control" placeholder="จำนวนเงิน" name="invoiceprice"></td>';
            if (number > 1) {

                html += '<td><a href="" class="btn btn-danger" id="remove" name="remove">ลบ</a></td>';
                $('tbody').append(html);
            }
            else{
                html += '<td><a href="" class="btn btn-primary" id="add" name="add">เพิ่ม</a></td>';
                $('tbody').append(html);
            }
        }

        $('#add').click(function(){
            count++;
            dynamic_field(count);
        });
        $(document).on('click','#remove', function(){
            count--;
           dynamic_field(count);
       });
    });
</script> -->