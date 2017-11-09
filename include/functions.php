<?php

	function pageContent( $pageAlias ) {
		global $dsn, $username, $password;
		$dbh = new PDO( $dsn, $username, $password );
		$sql = $dbh->prepare( "SELECT * FROM webpages WHERE wp_active='Y' AND wp_alias='" . $pageAlias . "'" );
		$sql->execute();
		$rows = $sql->fetchAll();
		echo urldecode( htmlspecialchars_decode( $rows[0]['wp_description'] ) );
	}

	function pageContentLimitWords( $pageAlias, $wordLimit ) {
		global $dsn, $username, $password;
		$dbh = new PDO( $dsn, $username, $password );
		$sql = $dbh->prepare( "SELECT * FROM webpages WHERE wp_active='Y' AND wp_alias='" . $pageAlias . "'" );
		$sql->execute();
		$rows = $sql->fetchAll();

		$str   = urldecode( htmlspecialchars_decode( $rows[0]['wp_description'] ) );
		$tail  = max( 0, $wordLimit - 10 );
		$trunk = substr( $str, 0, $tail );
		$trunk .= strrev( preg_replace( '~^..+?[\s,:]\b|^...~', '...', strrev( substr( $str, $tail, $wordLimit - $tail ) ) ) );
		echo $trunk;
	}

	function pageIntro( $pageAlias ) {
		global $dsn, $username, $password;
		$dbh = new PDO( $dsn, $username, $password );
		$sql = $dbh->prepare( "SELECT * FROM webpage WHERE wp_active='Y' AND wp_alias='" . $pageAlias . "'" );
		$sql->execute();
		$rows = $sql->fetchAll();
		echo urldecode( htmlspecialchars_decode( $rows[0]['wp_intro'] ) );
	}


	function pageTitle( $pageAlias ) {
		global $dsn, $username, $password;
		$dbh = new PDO( $dsn, $username, $password );
		$sql = $dbh->prepare( "SELECT * FROM webpages WHERE wp_active='Y' AND wp_alias='" . $pageAlias . "'" );
		$sql->execute();
		$rows = $sql->fetchAll();
		echo urldecode( htmlspecialchars_decode( $rows[0]['wp_title'] ) );
	}

	function prodCategoryData( $pageAlias ) {
		global $dsn, $username, $password;

		$dbh = new PDO( $dsn, $username, $password );
		$sql = $dbh->prepare( "SELECT * FROM p_categories WHERE pc_active='Y' AND pc_alias='" . $pageAlias . "'" );
		$sql->execute();
		$rows = $sql->fetchAll();

		//$data = $result;

		return json_encode( $rows );

		//return  urldecode(htmlspecialchars_decode( $rows[0]['pc_title']) );
	}

	function prodCategoryDataById( $pc_id ) {
		global $dsn, $username, $password;

		$dbh = new PDO( $dsn, $username, $password );
		$sql = $dbh->prepare( "SELECT * FROM p_categories WHERE pc_active='Y' AND pc_id='" . $pc_id . "'" );
		$sql->execute();
		$rows = $sql->fetchAll();

		//$data = $result;

		return json_encode( $rows );

		//return  urldecode(htmlspecialchars_decode( $rows[0]['pc_title']) );
	}

	function prodCategories() {
		global $dsn, $username, $password;

		$dbh = new PDO( $dsn, $username, $password );
		$sql = $dbh->prepare( "SELECT * FROM p_categories WHERE pc_active='Y' " );
		$sql->execute();
		$rows = $sql->fetchAll();

		//$data = $result;

		return json_encode( $rows );

		//return  urldecode(htmlspecialchars_decode( $rows[0]['pc_title']) );
	}

	function prodSubCategoryData( $pc_id ) {
		global $dsn, $username, $password;
		$catData = array();
		$dbh     = new PDO( $dsn, $username, $password );
		$sql     = $dbh->prepare( "SELECT * FROM p_subcategories psc LEFT JOIN
							  p_categories pc on psc.pc_id = pc.pc_id
							  WHERE pc.pc_active='Y' and  psc.psubc_active ='Y' and psc.pc_id='" . $pc_id . "'" );
		$sql->execute();
		$rows = $sql->fetchAll();

		return json_encode( $rows );


	}

	function prodSubCategoryDataBySubCatAlias( $pageAlias ) {
		global $dsn, $username, $password;
		$catData = array();
		$dbh     = new PDO( $dsn, $username, $password );
		$sql     = $dbh->prepare( "SELECT * FROM p_subcategories psc LEFT JOIN
							  p_categories pc on psc.pc_id = pc.pc_id
							  WHERE pc.pc_active='Y' and  psc.psubc_active ='Y' and psc.psubc_alias ='" . $pageAlias . "'" );
		$sql->execute();
		$rows = $sql->fetchAll();

		return json_encode( $rows );


	}


	function prodData( $pc_id, $psubc_id ) {
		global $dsn, $username, $password;
		$catData = array();
		$dbh     = new PDO( $dsn, $username, $password );
		$sql     = $dbh->prepare( "SELECT * FROM products p LEFT JOIN
                                p_categories pc ON p.p_pc_id = pc.pc_id
                                LEFT JOIN
                                p_subcategories psc ON p.psubc_id = psc.psubc_id
                                WHERE
                                p.p_active='Y' and pc.pc_active='Y' and  psc.psubc_active ='Y' and p.p_pc_id='" . $pc_id . "' and p.psubc_id='" . $psubc_id . "'" );
		$sql->execute();
		$rows = $sql->fetchAll();

		return json_encode( $rows );


	}

	function prodDatabyCatId( $pc_id) {
		global $dsn, $username, $password;
		$catData = array();
		$dbh     = new PDO( $dsn, $username, $password );
		$sql     = $dbh->prepare( "SELECT * FROM products p LEFT JOIN
                                p_categories pc ON p.p_pc_id = pc.pc_id
                                WHERE
                                p.p_active='Y' and pc.pc_active='Y'and p.p_pc_id='" . $pc_id . "' " );
		$sql->execute();
		$rows = $sql->fetchAll();

		return json_encode( $rows );


	}



	function getProductImgRandom( $p_id ) {
		global $dsn, $username, $password;
		$catData = array();
		$dbh     = new PDO( $dsn, $username, $password );
		$sql     = $dbh->prepare( "SELECT pi_image FROM products_images pi LEFT JOIN
                                products p ON pi.p_id = p.p_id
                                WHERE
                                p.p_active='Y' and p.p_id='" . $p_id . "' ORDER BY RAND() LIMIT 1" );
		$sql->execute();
		$rows = $sql->fetchAll();

		return $rows[0]['pi_image'];
	}

	function getProductMainImg( $p_id, $p_featured_img ) {
		global $dsn, $username, $password;
		$catData = array();
		$dbh     = new PDO( $dsn, $username, $password );
		$sql     = $dbh->prepare( "SELECT pi_image FROM products_images pi LEFT JOIN
                                products p ON pi.p_id = p.p_id
                                WHERE
                                p.p_active='Y' and p.p_id='" . $p_id . "' and pi.pi_id = '" . $p_featured_img . "' " );
		$sql->execute();
		$rows = $sql->fetchAll();

		if ( count( $rows ) > 0 ) {
			return $rows[0]['pi_image'];
		} else {
			return "";
		}


	}

	function getProductImgAll( $p_id ) {
		global $dsn, $username, $password;
		$catData = array();
		$dbh     = new PDO( $dsn, $username, $password );
		$sql     = $dbh->prepare( "SELECT pi_image FROM products_images
                                WHERE
                                p_id='" . $p_id . "' " );
		$sql->execute();
		$rows = $sql->fetchAll();

		return json_encode( $rows );

	}


	function prodDataByProdAlias( $catAlias, $subcatAlias, $pageAlias ) {
		global $dsn, $username, $password;
		$catData = array();
		$dbh     = new PDO( $dsn, $username, $password );
		$sql     = $dbh->prepare( "SELECT * FROM products p LEFT JOIN
                                p_categories pc ON p.p_pc_id = pc.pc_id
                                LEFT JOIN
                                p_subcategories psc ON p.psubc_id = psc.psubc_id
                                WHERE
                                p.p_active='Y' and pc.pc_active='Y' and  psc.psubc_active ='Y'  and pc.pc_alias='" . $catAlias . "'  and psc.psubc_alias='" . $subcatAlias . "'  and p.p_alias='" . $pageAlias . "'" );
		$sql->execute();
		$rows = $sql->fetchAll();

		return json_encode( $rows );


	}

	function prodDataByProdAliasAll( $catAlias, $pageAlias ) {
		global $dsn, $username, $password;
		$catData = array();
		$dbh     = new PDO( $dsn, $username, $password );
		$sql     = $dbh->prepare( "SELECT * FROM products p LEFT JOIN
                                p_categories pc ON p.p_pc_id = pc.pc_id
                                WHERE
                                p.p_active='Y' and pc.pc_active='Y' and    pc.pc_alias='" . $catAlias . "'  and p.p_alias='" . $pageAlias . "'" );
		$sql->execute();
		$rows = $sql->fetchAll();

		return json_encode( $rows );


	}

	function prodDataUpcoming() {
		global $dsn, $username, $password;
		$catData = array();
		$dbh     = new PDO( $dsn, $username, $password );
		$sql     = $dbh->prepare( "SELECT * FROM products p LEFT JOIN
                                p_categories pc ON p.p_pc_id = pc.pc_id
                                LEFT JOIN
                                p_subcategories psc ON p.psubc_id = psc.psubc_id
                                WHERE
                                p.p_active='Y' and pc.pc_active='Y' and  psc.psubc_active ='Y' and p.p_upcoming='Y'" );
		$sql->execute();
		$rows = $sql->fetchAll();

		return json_encode( $rows );


	}

	function prodSubCategoryTitle( $pageAlias ) {
		global $dsn, $username, $password;
		$dbh = new PDO( $dsn, $username, $password );
		$sql = $dbh->prepare( "SELECT * FROM p_subcategory WHERE psubc_alias='" . $pageAlias . "'" );
		$sql->execute();
		$rows = $sql->fetchAll();
		echo $rows[0]['psubc_title'];
	}

	function prodTitle( $pageAlias ) {
		global $dsn, $username, $password;
		$dbh = new PDO( $dsn, $username, $password );
		$sql = $dbh->prepare( "SELECT * FROM product WHERE p_active='Y' AND p_alias='" . $pageAlias . "'" );
		$sql->execute();
		$rows = $sql->fetchAll();
		echo $rows[0]['p_title'];
	}

	function clientDataByAlias( $pageAlias ) {
		global $dsn, $username, $password;
		$catData = array();
		$dbh     = new PDO( $dsn, $username, $password );
		$sql     = $dbh->prepare( "SELECT * FROM client_galleries cgl LEFT JOIN
							  clients cl on cgl.cl_id = cl.cl_id
							  WHERE cl.cl_active='Y' and  cgl.cgl_active ='Y' and cl.cl_alias ='" . $pageAlias . "'" );
		$sql->execute();
		$rows = $sql->fetchAll();

		return json_encode( $rows );


	}


	function prodApprovals( $pageAlias ) {
		global $dsn, $username, $password;
		$dbh = new PDO( $dsn, $username, $password );
		$sql = $dbh->prepare( "SELECT * FROM product WHERE p_active='Y' AND p_alias='" . $pageAlias . "'" );
		$sql->execute();
		$rows = $sql->fetchAll();

		return $rows[0]['ai_id'];
	}


	function exhibitionTitle( $pageAlias ) {
		global $dsn, $username, $password;
		$dbh = new PDO( $dsn, $username, $password );
		$sql = $dbh->prepare( "SELECT * FROM exhibition WHERE ex_active='Y' AND ex_alias='" . $pageAlias . "'" );
		$sql->execute();
		$rows = $sql->fetchAll();

		return $rows[0]['ex_title'];
	}

	function exhibitionDetails( $pageAlias ) {
		global $dsn, $username, $password;
		$dbh = new PDO( $dsn, $username, $password );
		$sql = $dbh->prepare( "SELECT * FROM exhibition WHERE ex_active='Y' AND ex_alias='" . $pageAlias . "'" );
		$sql->execute();
		$rows = $sql->fetchAll();

		return $rows[0]['ex_venue'] . " : " . $rows[0]['ex_dates'];
	}


?>