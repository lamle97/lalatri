<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	private $data = array();
	private $action;

    public function __construct()
    {
	    parent::__construct();

	    $this->load->model('customer/customer');

	    $this->action = isset($_GET['act'])?$_GET['act']:"";
	    $this->data['result']['status'] = true;
        $this->data['result']['data'] = null;
    }

	public function index()
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->data));
	}

    private function show()
    {
        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->data));
    }

	private function checkToken()
	{
	    if (isset($_GET['token']) )
	    {
	    	$customer_id = $this->cache->file->get('customer.' . $_GET['token']);

	    	if ($customer_id)
	    	{
	    		$this->customer->setCustomer($customer_id);
	    		return true;
	    	}
	    	else
	    	{
	    		$this->data['result']['status'] = false;
	    		//$this->data['result']['data'] = "Your token is false";
	    	} 
	    }
	    else 
	    {
	    	$this->data['result']['status'] = false;
            //$this->data['result']['data'] = "Please insert token to use api";
	    }
	    return false;		
	}

	public function customer()
    {
    	$this->load->model('customer/cart', "dbcart");
        $this->load->model('customer/wishlist');
        $this->load->model('catalog/product');
        $this->load->model('customer/customer_social');

    	switch ($this->action) {
    		case 'login':
    			if (isset($_GET['email']) && isset($_GET['password'])) 
    			{
    				if($customer_id = $this->customer->login($_GET['email'], $_GET['password'])) 
    				{
    					$token = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 10);
    					$this->cache->file->save('customer.' . $token, $customer_id, 5*3600);
    					$this->data['result']['data'] = $token;
    				}
    				else 
    				{
    					$this->data['result']['status'] = false;
    					//$this->data['result']['data'] = "Login failed";
    				}
    			}
                else if (isset($_GET['social_id']) && isset($_GET['network']))
                {
                    if($customer_id = $this->customer_social->login($_GET['social_id'], $_GET['network'])) 
                    {
                        $token = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 10);
                        $this->cache->file->save('customer.' . $token, $customer_id, 5*3600);
                        $this->data['result']['data'] = $token;
                    }
                    else 
                    {
                        $this->data['result']['status'] = false;
                        //$this->data['result']['data'] = "Login failed";
                    }                    
                }
    			else 
    			{
    				$this->data['result']['status'] = false;
    				//$this->data['result']['data'] = "Missing field to do action";
    			}
    			break;
            case 'register':
                if (isset($_GET['email']) && isset($_GET['firstname']) && isset($_GET['lastname'])  && (isset($_GET['password']) || (isset($_GET['social_id']) && isset($_GET['network'])))) 
                {
                    if (!$this->customer_social->addCustomer($_GET))
                        $this->data['result']['status'] = false;                    
                }
                else 
                {
                    $this->data['result']['status'] = false;
                    //$this->data['result']['data'] = "Missing field to do action";
                }
                break;
            case 'addSocial':
                if ($this->checkToken() && (isset($_GET['social_id']) && isset($_GET['network']))) 
                {
                    $this->data['result']['status'] = $this->customer_social->addSocial($this->customer->isLogged(), $_GET['social_id'], $_GET['network']);                        
                }
                else 
                {
                    $this->data['result']['status'] = false;
                    //$this->data['result']['data'] = "Missing field to do action";
                }
                break;                                 
    		case 'getCustomer':
    			if ($this->checkToken())
    			{
    				$this->data['result']['data'] = $this->customer->getCustomer();
    			}
    			break;
    		case 'getCart':
                if ($this->checkToken())
                {
        			$this->data['result']['data'] = $this->dbcart->get();
                    foreach ($this->data['result']['data'] as $key => $value) {
                        $this->data['result']['data'][$key] = $this->product->getProductByProductOptionId($value['product_option_id']); 
                        $this->data['result']['data'][$key]['quantity_cart'] =  $value['quantity'];
                    }   
                }               
    			break;
            case 'getCartMoney':
                if ($this->checkToken())
                {
                    $this->data['result']['data'] = $this->dbcart->total();
                }
                break;       
            case 'getCartTotal':
                if ($this->checkToken())
                {
                    $this->data['result']['data'] = $this->dbcart->total_items();
                }
                break;                          
    		case 'addCart':
                if ($this->checkToken())
                {
    				if (isset($_GET['product_option_id']) && isset($_GET['quantity']))
    				{
        				$this->data['result']['status'] = $this->dbcart->add($_GET['product_option_id'], $_GET['quantity']);
        				$this->data['result']['data'] = $this->dbcart->get();
    				}
        			else 
        			{
    					$this->data['result']['status'] = false;
    					//$this->data['result']['data'] = "Missing field to do action";
    				}	
                }
    			break;
    		case 'updateCart':
                if ($this->checkToken())
                {
    				if (isset($_GET['product_option_id']) && isset($_GET['quantity']))
    				{
        				$this->data['result']['status'] = $this->dbcart->update($_GET['product_option_id'], $_GET['quantity']);
        				$this->data['result']['data'] = $this->dbcart->get();
    				}
        			else 
        			{
    					$this->data['result']['status'] = false;
    					//$this->data['result']['data'] = "Missing field to do action";
    				}	
                }
    			break;    	
    		case 'deleteCart':
                if ($this->checkToken())
                {
    				if (isset($_GET['product_option_id']))
    				{
        				$this->dbcart->delete($_GET['product_option_id']);
        				$this->data['result']['data'] = $this->dbcart->get();
    				}
        			else 
        			{
    					$this->data['result']['status'] = false;
    					//$this->data['result']['data'] = "Missing field to do action";
    				}	
                }
    			break;   
    		case 'clearCart':
                if ($this->checkToken())
                {
    			 $this->data['result']['data'] = $this->dbcart->clear();	
                }
    			break;
            case 'getWish':
                if ($this->checkToken())
                {
                    $this->data['result']['data'] = $this->wishlist->get(); 
                    foreach ($this->data['result']['data'] as $key => $value) {
                        $this->data['result']['data'][$key] = $this->product->getProduct($value['product_id']); 
                    }  
                }
                break;
            case 'getWishTotal':
                if ($this->checkToken())
                {
                    $this->data['result']['data'] = count($this->wishlist->get());   
                }
                break;                
            case 'addWish':
                if ($this->checkToken())
                {
                    if (isset($_GET['product_id']))
                    {
                        $this->wishlist->add($_GET['product_id']);
                        $this->data['result']['data'] = $this->wishlist->get();
                    }
                    else 
                    {
                        $this->data['result']['status'] = false;
                       // $this->data['result']['data'] = "Missing field to do action";
                    }   
                }
                break;
            case 'deleteWish':
                if ($this->checkToken())
                {
                    if (isset($_GET['product_id']))
                    {
                        $this->wishlist->delete($_GET['product_id']);
                        $this->data['result']['data'] = $this->wishlist->get();
                    }
                    else 
                    {
                        $this->data['result']['status'] = false;
                        //$this->data['result']['data'] = "Missing field to do action";
                    }   
                }
                break;
            case 'clearWish':
                if ($this->checkToken())
                {
                    $this->wishlist->clear(); 
                    $this->data['result']['data'] = $this->wishlist->get();
                }
                break;
            case 'checkWished':
                if ($this->checkToken())
                {
                    if (isset($_GET['product_id']))
                    {
                        $this->data['result']['status'] = $this->wishlist->checkWished($_GET['product_id']);
                    }
                    else 
                    {
                        $this->data['result']['status'] = false;
                        //$this->data['result']['data'] = "Missing field to do action";
                    }  
                }
                break;

    		default:
    			$this->data['result']['status'] = false;
    			//$this->data['result']['data'] = "Your request failed";
    			break;
    	}
    	$this->show();
    }

	public function category()
	{
		$this->load->model('catalog/category');

    	switch ($this->action) {
    		case 'getCategory':
    			if (isset($_GET['category_id'])) 
    			{
    				$this->data['result']['data'] = $this->category->getCategory($_GET['category_id']);
    			}
    			else 
    			{
    				$this->data['result']['status'] = false;
    				//$this->data['result']['data'] = "Missing field to do action";
    			}
    			break;
    		case 'getCategories':
    			if (isset($_GET)) 
    			{
    				$this->data['result']['data'] = $this->category->getCategories($_GET);
    			}
    			else 
    			{
    				$this->data['result']['data'] = $this->category->getCategories();
    			}
    			break; 
            case 'getCategories':
                if (isset($_GET)) 
                {
                    $this->data['result']['data'] = $this->category->getCategories($_GET);
                }
                else 
                {
                    $this->data['result']['data'] = $this->category->getCategories();
                }
                break;                 
    		case 'getTotalCategories':
    			if (isset($_GET['parent_id'])) 
    			{
    				$this->data['result']['data'] = $this->category->getTotalCategoriesByCategoryId($_GET['parent_id']);
    			}
    			else 
    			{
    				$this->data['result']['data'] = $this->category->getTotalCategoriesByCategoryId(0);
    			}
    			break;     		   		
            case 'getDesktop':
                $this->load->model('catalog/product');
                $this->data['result']['data'] = $this->cache->file->get('productApiDesktop');
                if (!$this->data['result']['data'])
                {                
                    $category = $this->category->getCategories(array('parent_id' => 0, 'status' => 1));
                    foreach ($category  as $key => $value) {
                        $filter = array(
                            'filter_category_id' => $value['category_id'],
                            'filter_sub_category' => true,
                            'sort' => 'p.date_added',
                            'order' => 'DESC',
                            'start' => 0,
                            'limit' => 10
                        );
                        if(count($products = $this->product->getProducts($filter)) > 0) {
                            $this->data['result']['data'][$key]['category_id'] = $value['category_id'];
                            $this->data['result']['data'][$key]['name'] = $value['name'];
                            $this->data['result']['data'][$key]['products'] = $products;
                        }                    
                    }
                    $this->cache->file->save('productApiDesktop', $this->data['result']['data'], 24*3600);
                }
				else 
				{
					foreach ($this->data['result']['data'] as $i => $products) {
						foreach ($products['products'] as $j => $product) {
							$this->data['result']['data'][$i]['products'][$j] = $this->product->getProduct($product['product_id']);
						}
					}
				}                
                break;     		
    		default:
    			$this->data['result']['status'] = false;
    			//$this->data['result']['data'] = "Your request failed";
    			break;
    	}
    	$this->show();
	}

	public function product()
	{
		$this->load->model('catalog/product');

    	switch ($this->action) {
    		case 'getProduct':
    			if (isset($_GET['product_id'])) 
    			{
    				$this->data['result']['data'] = $this->product->getProduct($_GET['product_id']);
    			}
    			else 
    			{
    				$this->data['result']['status'] = false;
    				//$this->data['result']['data'] = "Missing field to do action";
    			}
    			break;
    		case 'getProductByProductOptionId':
    			if (isset($_GET['product_option_id'])) 
    			{
    				$this->data['result']['data'] = $this->product->getProductByProductOptionId($_GET['product_option_id']);
    			}
    			else 
    			{
    				$this->data['result']['status'] = false;
    				//$this->data['result']['data'] = "Missing field to do action";
    			}
    			break;    			
    		case 'getProducts':
    			$this->data['result']['data'] = $this->product->getProducts($_GET);
    			break; 
            case 'getProductId':
                if (isset($_GET['model'])) 
                {
                    if($data = $this->product->getProductId($_GET['model']))
                        $this->data['result']['data'] = $data;
                    else {
                        $this->data['result']['status'] = false;
                    }
                }
                else
                {
                    $this->data['result']['status'] = false;
                    //$this->data['result']['data'] = "Missing field to do action";
                }
                break;                  
    		case 'getProductSpecials':
    			$this->data['result']['data'] = $this->product->getProductSpecials($_GET);
    			break;     		   		
    		case 'getLatestProducts':
    		    if (isset($_GET['limit'])) 
    			{
    				$this->data['result']['data'] = $this->product->getLatestProducts($_GET['limit']);
    			}
    			else
    			{
    				$this->data['result']['data'] = $this->product->getLatestProducts(5);
    			}
    			break;   
    		case 'getPopularProduct':
    		    if (isset($_GET['limit'])) 
    			{    		
    				$this->data['result']['data'] = $this->product->getPopularProduct($_GET['limit']);
    			}
    			else
    			{
    				$this->data['result']['data'] = $this->product->getPopularProduct(5);
    			}
    			break;   
    		case 'getBestSellerProducts':
    		    if (isset($_GET['limit'])) 
    			{    		
    				$this->data['result']['data'] = $this->product->getBestSellerProducts($_GET['limit']);
    			}
    			else
    			{
    				$this->data['result']['data'] = $this->product->getBestSellerProducts(5);
    			}
    			break; 
            case 'getOptionsByProductId':
                if (isset($_GET['product_id'])) 
                {
                    $options = $this->product->getOptionsByProductId($_GET['product_id']);

                    foreach ($options as $key => $value) {
                        $options[$key]['images'] = $this->product->getImagesByProductOptionId($value['product_option_id']);
                    }

                    $this->data['result']['data'] = $options;
                }
                else 
                {
                    $this->data['result']['status'] = false;
                    //$this->data['result']['data'] = "Missing field to do action";
                }
                break;            
            case 'getImagesByProductOptionId':
                if (isset($_GET['product_option_id'])) 
                {
                    $this->data['result']['data'] = $this->product->getImagesByProductOptionId($_GET['product_option_id']);
                }
                else 
                {
                    $this->data['result']['status'] = false;
                    //$this->data['result']['data'] = "Missing field to do action";
                }
                break;

    		default:
    			$this->data['result']['status'] = false;
    			//$this->data['result']['data'] = "Your request failed";
    			break;
    	}
    	$this->show();			
	}	

    public function setting()
    {
        $this->load->model('system/setting');

        switch ($this->action) {
            case 'getSlider':
                $slider = $this->setting->getSettingValue('slider');
                foreach ($slider as $key => $value) {
                    if (preg_match('/products\/(.*)/', $value['link'], $match)) {
                        $slider[$key]['type'] = 'product';
                        $slider[$key]['id'] = $match[1];
                    }
                    else if (preg_match('/categories\/(.*)/', $value['link'], $match)) {
                        $slider[$key]['type'] = 'category';
                        $slider[$key]['id'] = $match[1];
                    }  
                    else {
                        $slider[$key]['type'] = 'none';
                        $slider[$key]['id'] = null;
                    }                  
                }
                
                $this->data['result']['data'] = $slider;
                break;        
            case 'getSetting':                
                $this->data['result']['data'] = $this->setting->getSetting();
                break;

            default:
                $this->data['result']['status'] = false;
                //$this->data['result']['data'] = "Your request failed";
                break;
        }
        $this->show();
    }

    public function review()
    {
        $this->load->model('catalog/review');

        switch ($this->action) {
            case 'getReviews':
                if (isset($_GET['product_id'])) 
                {
                    $this->data['result']['data'] = $this->review->getReviewsByProductId($_GET['product_id'], 0, 1000);
                }
                else 
                {
                    $this->data['result']['status'] = false;
                    //$this->data['result']['data'] = "Missing field to do action";
                }    
                break;
            case 'addReview':
                if ($this->checkToken()) 
                {
                    if (isset($_GET['product_id']) && isset($_GET['text']) && isset($_GET['rating'])) 
                    {
                        $data['customer_id'] = $this->customer->isLogged();
                        $data['product_id'] = $_GET['product_id'];
                        $data['text'] = $_GET['text'];
                        $data['rating'] = $_GET['rating'];
                        $data['status'] = 1;
                        $review_id = $this->review->addReview($data);   
                        $this->data['result']['data'] =  null;                     
                    }
                    else 
                    {
                        $this->data['result']['status'] = false;
                        //$this->data['result']['data'] = "Missing field to do action";
                    }  
                }
                break;

            default:
                $this->data['result']['status'] = false;
                //$this->data['result']['data'] = "Your request failed";
                break;
        }
        $this->show();        
    }

    public function order()
    {
        $this->load->model('sales/order');
        $this->load->model('sales/payment');
        $this->load->model('catalog/product');

        switch ($this->action) {
            case 'getOrders':
                if ($this->checkToken()) 
                {   
	                $this->data['result']['data'] = $this->order->getOrderByCustomerId($this->customer->isLogged());                           
            	}
                break;        	
            case 'getOrder':
                if ($this->checkToken()) 
                {   
	                if (isset($_GET['order_id'])) 
	                {
				        $this->data['result']['data'] = $this->order->getOrder($_GET['order_id']);
				        

				        $this->data['result']['data']['payment'] = $this->payment->getPayment($this->data['result']['data']['payment_id']);
				        $this->data['result']['data']['products'] = $this->order->getProductsOrder($_GET['order_id']); 
				        foreach ($this->data['result']['data']['products'] as $key => $product) {
				        	$product_id = $this->product->getProductByProductOptionId($product['product_option_id']);
				        	$this->data['result']['data']['products'][$key]['product_id'] = $product_id;
				        }

				        if (!isset($this->data['result']['data']['customer_id']) || $this->data['result']['data']['customer_id'] != $this->customer->isLogged()){
				            $this->data['result']['status'] = false;
				            $this->data['result']['data'] = null;
				        }
	                }
	                else 
	                {
	                    $this->data['result']['status'] = false;
	                    //$this->data['result']['data'] = "Missing field to do action";
	                }                            
            	}
                break;

            default:
                $this->data['result']['status'] = false;
                //$this->data['result']['data'] = "Your request failed";
                break;
        }
        $this->show();        
    }    
}
