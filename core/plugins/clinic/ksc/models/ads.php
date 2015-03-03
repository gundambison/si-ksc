<?php
class Models_Pas_Ads_Ads extends Base_Model {
	
	public function __construct(){
		parent::__construct();
		$this->loadConnection('default');
	}
	
	public function request($clientcode, $appcode, $width, $height, $menu_id){
		
		$sqlPage = '';
		if($menu_id != false || $menu_id !=''){
			$sqlPage = sprintf(' AND a.ads_menu_rank=%d ', $this->conn->real_escape_string($menu_id));
		}
		
		$sql = sprintf("SELECT 
				a.ads_id as id,
                                a.ads_menu_rank as mid,
				a.ads_url as url,
                                a.ads_filename as image
			FROM 
				tbl_core_ads a 
			LEFT JOIN 
				tbl_core_ads_campaign b
				ON a.ads_campaign_id=b.campaign_id
			LEFT JOIN
				tbl_core_application c 
				ON b.application_id=c.application_id
			LEFT JOIN
				tbl_core_ads_image d
				ON a.ads_size_id=d.image_id
			WHERE 
				c.application_code=%d 
			AND 
				d.image_width=%d
			AND 
				d.image_height=%d
			%s
			AND
				a.ads_status=1
			AND 
				b.campaign_status=1
			AND 
				b.campaign_startdate <= now() AND b.campaign_enddate>=now() ", 
			$this->conn->real_escape_string($appcode),
			$this->conn->real_escape_string($width),
			$this->conn->real_escape_string($height),
			$sqlPage
		);
		
		$result = $this->_query($sql);
		
		if( $result ){
			if($this->conn->affected_rows != 0) {
				$data = array();
				foreach( $this->_fetchAll($result) as $row ){
					$row['image'] = $this->config->app('contentImagesUrl') . 'ads/' . $row['image'];
					$data[] = $row;
				}
				return $data;
			}
			else{
				return 'NODATA';
			}
		}
		else{
			return false;
		}
	}
}
