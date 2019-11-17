<?php

class ContactsDataTables extends Ui
{
	function __construct() {
        parent::__construct();
	}
	
	public $curentLink = '/contacts';

    public function keys()
    {
    	$key = [];

    	$key[] = ['label'=>'#', 'cls'=>'td-index', 'type'=>'index'];
    	$key[] = ['id'=>'name', 'label'=>'ชื่อ', 'cls'=>'td-name', 'type' => 'groupName', 'icon'=>'user-circle'];
    	$key[] = ['id'=>'email', 'label'=>'อีเมล', 'cls'=>'td-email', 'icon'=>'envelope'];
    	$key[] = ['id'=>'phone_number', 'label'=>'หมายเลขโทรศัพท์', 'cls'=>'td-phone', 'icon'=>'phone-alt'];
    	$key[] = ['id'=>'company', 'label'=>'ตำแหน่งงานและบริษัท', 'cls'=>'td-company', 'icon'=>'building'];
		// $key[] = ['id'=>'tags', 'label'=>'แท็ก', 'cls'=>'td-group-status'];
		
    	$key[] = ['id'=>'updated_at', 'label'=>'แก้ไขล่าสุด', 'cls'=>'td-date td-light', 'type'=>'date', 'icon'=>'calendar-alt'];
    	$key[] = ['id'=>'action', 'cls'=>'td-action', 'type'=>'action'];

    	return $key;
    }

    public function init( $data, $ops=array() )
    {

    	$tr = '';
    	$keys = $this->keys();

    	$seq = ($ops['page'] * $ops['limit']) - $ops['limit'];


    	// title
    	if( $ops['page']==1 ){
	    	$ths = '';
	    	foreach ($keys as $key => $value) {

	    		$label = isset($value['label']) ?$value['label']: '';

	    		$ico = isset($value['icon']) ? '<i class="mr-1 fal fa-'.$value['icon'].'"></i>':'';
	    		$cls = isset($value['cls']) ? ' class="'.$value['cls'].'"':'';
				$ths .= '<th'.$cls.'>'.$ico.'<span>'.$label.'</span></th>';
				//  data-col="'.$key.'"
			}
			$tr .= '<tr role="table__fixed">'.$ths.'</tr>';
		}



		foreach ($data as $key => $item) {
			$seq ++;
			$item = json_decode( json_encode($item), 1);

			$tds = '';
			foreach ($keys as $label) {

				$type = isset($label['type'])? $label['type']: 'text';
				$val = '';
				if( $type=='text' ){

					$val = !empty($item[$label['id']])? $item[$label['id']]: '';

				} else if($type=='groupName'){

					$val = $this->groupName( $item );

				} else if($type=='index'){
					$val = $seq;

				} else if($type=='date'){
					 if( !empty($item[$label['id']]) ){
			            $val = date('Y/m/d H:s', strtotime($item[$label['id']]));
			        }

			        $val = '<span ref="updated_str">'.$val.'</span>';

				} else if($type=='move'){
					$val = '<div class="handle"></div>';

				} else if($type=='status'){
					$val = $this->_status( $item );
				} else if($type=='action'){
					$val = $this->actions( $item );;

				}


	    		$cls = isset($label['cls']) ? ' class="'.$label['cls'].'"':'';
				$tds .= '<td'.$cls.'>'.$val.'</td>';
			}

			$tr .= '<tr contact-id="'.$item['id'].'">'.$tds.'</tr>';
		}

    	return $tr;
    }


    public function groupName($data)
    {

        $picture = !empty($data['avatar_url'])
            ? '<img src="'. $data['avatar_url'].'" alt="" style="width:100%" />'
            : '<i class="far fa-user" style="position: absolute;top: 50%;left: 50%;color: #fff;margin-top: -8px;margin-left: -7px;"></i>';

    	return '<div class="media align-items-center">
			<div class="pic-wrap mr-2" style="width: 36px;"><div class="pic pic-circle rounded-circle"  ref="avatar_url" data-type="image">'.$picture.'</div></div>
			<div class="media-body">'.
				'<a href="'.asset( "{$this->curentLink}/{$data['id']}" ).'/edit" data-plugin="lightbox"><strong ref="name">'.$data['name'].'</strong></a>'.
			'</div>
		</div>';
    }

    public function _status($data)
    {
    	$val = '';

    	if( !empty($data['status_arr']) ){
    		$val = '<div class="ui-status" style="background-color:'.$data['status_arr']['color'].';color:#fff" data-ref="status_arr" data-type="status">'.$data['status_arr']['name'].'</div>';

    	}
    	else{
	    	switch ($data['status']) {
                case 0:
	    			$val = '<div class="ui-status" data-ref="status" data-type="status">แบบร่าง</div>';
                    break;

	    		case 1:
	    			$val = '<div class="ui-status primary" data-ref="status" data-type="status">ใช้งาน</div>';
	    			break;

	    		case 2:
	    			$val = '<div class="ui-status danger" data-ref="status" data-type="status">ระงับ</div>';
	    			break;
	    	}
    	}

    	return $val;
    }


    public function actions($data)
    {
    	$val = '<a href="'.asset( $this->curentLink. '/'.$data['id']).'/edit" data-plugin="lightbox" class="btn btn-sm btn-outline-primary" title="แก้ไข"><i class="far fa-pen"></i></a>';
		$val .= '<a href="'.asset( $this->curentLink. '/'.$data['id'].'/delete').'" data-plugin="lightbox" class="btn btn-sm btn-outline-danger ml-2" title="ลบ"><i class="far fa-trash-alt"></i></a>';

		return $val;
    }
}
