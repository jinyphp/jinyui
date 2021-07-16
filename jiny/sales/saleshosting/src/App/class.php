<?php
	echo "class test <br>";

	$site_env = "site value";

	class a {
		protected $glob;

    public function __construct() {
        global $site_env;
        $this->glob =& $site_env;
    }


		function site(){
			echo $this->glob;
		}

		function _a(){
			echo "print a <br>";
		}

		function __a(){
			return "__a";
		}
	}

	class b {
		function _b(){
			echo "print a <br>";
		}

		function _bb(){
			a::_a();
		}

		function _printa($value){
			echo "return : $value <br>";
		}
	}

	$a = new a;
	$b = new b;

	$a->site();

	$a->_a();

	$b->_bb();

	$b->_printa( $a->__a() );




?>