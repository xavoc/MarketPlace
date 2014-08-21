<?php

namespace MarketPlace;

class View_Lister_ComponentLister extends \CompleteLister {
		public $from_system=false;	
		function formatRow(){
		$type = $this->current_row['type'] = strtoupper(substr($this->model['type'], 0,1));
		switch ($type) {
			case 'M':
				$panel_type='success';
				$icon = 'gear';
				break;
			case 'P':
				$panel_type='warning';
				$icon = 'angle-double-right';
				break;
			case 'A':
				$panel_type='danger';
				$icon = 'gears';
				break;
		}
		$this->current_row['panel_type'] = $panel_type;

		$check_installed = $this->add('Model_InstalledComponents')
								->addCondition('epan_id',$this->api->current_website->id)
								->addCondition('component_id',$this->model->id)
								->setOrder('component_id')
								->tryLoadAny();
		
		if($check_installed->loaded()){
			$this->current_row['icon']='check-circle';
		}else{
			$this->current_row['icon']=$icon;
		}

		$this->current_row['info_btn'] = $this->js()->univ()->frameURL($this->model['name'],$this->api->url('MarketPlace_page_more',array('component_id'=>$this->model->id)));
		if(strpos($_SERVER['HTTP_HOST'], "epan.in") !== false)
			$this->current_row['download_components'] = "";

		// if(!$this->from_system)
		// 	$this->add('Controller_EpanCMSApp')->cmsMarketPlaceView();

	}

	function defaultTemplate(){
		$l=$this->api->locate('addons',__NAMESPACE__, 'location');
		$this->api->pathfinder->addLocation(
			$this->api->locate('addons',__NAMESPACE__),
			array(
		  		'template'=>'templates',
		  		'css'=>'templates/css'
				)
			)->setParent($l);
		return array('view/MarketPlace-ComponentStore1');
	}
}