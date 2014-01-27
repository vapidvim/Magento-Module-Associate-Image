<?php 
 class JD_VariationImage_IndexController extends Mage_Core_Controller_Front_Action {        
    public function indexAction()
    {   
		$c = 0;
		$collectionConfigurable = Mage::getResourceModel('catalog/product_collection')
                                    ->addAttributeToFilter('type_id', array('eq' => 'configurable'));                                       
						
            foreach ($collectionConfigurable as $_configurableproduct) {
                $product = Mage::getModel('catalog/product')->load($_configurableproduct->getId()); 
				Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
                //if($product->isSaleable()) {   
				
                    $childIds = Mage::getModel('catalog/product_type_configurable')->getChildrenIds($product->getId());
					foreach($childIds[0] as $key=>$val) {
                        $associatedProduct = Mage::getModel('catalog/product') ->load($val);
						$isimage = $associatedProduct->getImage();
						if($isimage == "no_selection" || empty($isimage)){
							$parentimage = Mage::getBaseDir('media'). '/catalog/product'. $product->getImage();
							if(is_file($parentimage)){
								$associatedProduct->setMediaGallery(array('images'=>array (), 'values'=>array ()));
								$associatedProduct->addImageToMediaGallery( $parentimage, array ('image', 'small_image', 'thumbnail'), false, false);
								$associatedProduct->save();
								echo $val. ' Success. ';
								$c ++;
							}
						}
                    }             
               // }           
            } 
		if($c == 0){echo 'No Products To Update.';}
        die;
    }
}
