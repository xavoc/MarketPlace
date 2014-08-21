<?php

class page_MarketPlace_page_more extends Page {

	function page_index(){
		$this->api->stickyGET('component_id');

		$component = $this->add('Model_MarketPlace')->load($_GET['component_id']);
		$this->setModel($component);
		
		if(is_file($path = getcwd().'/epan-components/'.$component['namespace'].'/templates/view/'.$component['namespace'].'-about.html')){
			$l=$this->api->locate('addons',$component['namespace'], 'location');
			$this->api->pathfinder->addLocation(
			$this->api->locate('addons',$component['namespace']),
			array(
		  		'template'=>'templates',
		  		'css'=>'templates/css'
				)
			)->setParent($l);

			$about_component = $this->add('View',null,null,array('view/'.$component['namespace'].'-about'));
		}

	}

	function defaultTemplate(){
		return array('owner/installcomponent');
	}
}