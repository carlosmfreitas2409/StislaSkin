<?php
///////////////////////////////////////////////
///  Pilot Career Page v1.2 by php-mods.eu  ///
///            Author php-mods.eu           ///
///           Packed at 25/05/2016          ///
///     Copyright (c) 2016, php-mods.eu     ///
///////////////////////////////////////////////

class Career extends CodonModule {
	
	public function index() {				
		$this->set('generaward', CareerData::getgenaward());
		$this->set('ranks', CareerData::getranks());
		$this->show('career');
	}  
}
