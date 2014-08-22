<?php

namespace MarketPlace;

class View_Tools_ComponentStore extends \componentBase\View_Component{
	function init(){
		parent::init();
		
		//TODO keep the line below in single CMS
		// $this->add('Controller_EpanCMSApp')->ownerComponentRepository();

		
		$market_place = $this->add('Model_MarketPlace');
		$market_place->addCondition('type','<>','element');
		$market_place->addCondition('is_system',false);

		if($_GET['search']){
			$market_place->addCondition('name','like','%'.$_GET['search'].'%');
		}

		$mp = $this->add('MarketPlace/View_Lister_ComponentLister');
		$mp->setModel($market_place);
		$mp->add('Paginator')->ipp(15);


	}

	// defined in parent class
	// Template of this tool is view/namespace-ToolName.html
}
