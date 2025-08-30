<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends MY_Controller {
	
	public function __construct(){
	   parent::__construct();
	   
	    if(!$this->isAdminLoggedIn()){
			 redirect(ADMIN_FOLDER);		
		}
	 
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	 
	 
	 
	 
	 
	 	 	 	public function poolIncome() {
		$model = new OperationModel();
		$this->load->view(ADMIN_FOLDER.'/reports/poolIncome',$data);  }
	 		public function poolIncomeList() {
		$model = new OperationModel();
		$this->load->view(ADMIN_FOLDER.'/reports/poolIncomeList',$data);  }
	 	
	 
	 
	 	 	public function binaryRoiIncome() {
		$model = new OperationModel();
		$this->load->view(ADMIN_FOLDER.'/reports/binaryRoiIncome',$data);  }
	 		public function binaryRoiList() {
		$model = new OperationModel();
		$this->load->view(ADMIN_FOLDER.'/reports/binaryRoiList',$data);  }
	 	
	 	 
	 	 
	    public function rankAchievers(){
	    $model = new OperationModel();
	    $this->load->view(ADMIN_FOLDER.'/reports/rankAchievers',$data); }
	    
	       public function rankAchieversList(){
	    $model = new OperationModel();
	    $this->load->view(ADMIN_FOLDER.'/reports/rankAchieversList',$data); }
	 
	  public function founderreports(){
	    $model = new OperationModel();
	    $this->load->view(ADMIN_FOLDER.'/reports/founderreports',$data); }
	 	  public function royaltyreports(){
	    $model = new OperationModel();
	    $this->load->view(ADMIN_FOLDER.'/reports/royaltyreports',$data); }
	    public function royaltyreportslist(){
	    $model = new OperationModel();
	    $this->load->view(ADMIN_FOLDER.'/reports/royaltyreportslist',$data); }
	  public function royalty_bonus(){
	    $model = new OperationModel();
	    $this->load->view(ADMIN_FOLDER.'/reports/quick',$data); }
	  public function royalty_bonusList(){
	    $model = new OperationModel();
	    $this->load->view(ADMIN_FOLDER.'/reports/quickIncomeList',$data); }	    
	   public function CommunityIncome(){
	    $model = new OperationModel();
	    $this->load->view(ADMIN_FOLDER.'/reports/CommunityIncome',$data); }
	   public function CommunityIncomeList(){
	    $model = new OperationModel();
	    $this->load->view(ADMIN_FOLDER.'/reports/CommunityIncomeList',$data); }
   public function LevelBonus(){
	    $model = new OperationModel();
	    $this->load->view(ADMIN_FOLDER.'/reports/LevelIncome',$data); }
	     public function pool_bonus(){
	    $model = new OperationModel();
	    $this->load->view(ADMIN_FOLDER.'/reports/BoardIncome',$data); }  
	    public function LevelIncomeList(){
	    $model = new OperationModel();
	    $this->load->view(ADMIN_FOLDER.'/reports/LevelIncomeList',$data); }
	  
	    
	     public function directROI(){
	    $model = new OperationModel();
	    $this->load->view(ADMIN_FOLDER.'/reports/directROI',$data); }
	    
	    public function directROIlist(){
	    $model = new OperationModel();
	    $this->load->view(ADMIN_FOLDER.'/reports/directROIlist',$data); }
	    
	    
	    public function direct_referral_bonus(){
	    $model = new OperationModel();
	    $this->load->view(ADMIN_FOLDER.'/reports/directincomelist',$data); }
	   public function direct_referral_bonuslist(){
	    $model = new OperationModel();
	    $this->load->view(ADMIN_FOLDER.'/reports/directincome',$data); }
        public function binaryincome(){
	    $model = new OperationModel();
	    $this->load->view(ADMIN_FOLDER.'/reports/binaryincome',$data); }
	
	    public function binaryincomelist() {
		$model = new OperationModel();
		$this->load->view(ADMIN_FOLDER.'/reports/binaryincomelist',$data);  }
       
	   	public function miningbonus() {
		$model = new OperationModel();
		$this->load->view(ADMIN_FOLDER.'/reports/dailyincomelist',$data);  }
		
		public function miningbonuslist() {
		$model = new OperationModel();
		$this->load->view(ADMIN_FOLDER.'/reports/dailyincome',$data);  }
		
	    public function rewardList() {
		$model = new OperationModel();
		$this->load->view(ADMIN_FOLDER.'/reports/rewardList',$data);  }
		
		 public function rank_bonus() {
		$model = new OperationModel();
		$this->load->view(ADMIN_FOLDER.'/reports/RewardIncome',$data);  }
		

	
		
		
		 public function poolAchiever()
		{
		$this->load->view(ADMIN_FOLDER.'/reports/poolAchiever',$data);  }
		 		 public function PoolAchieversList()
		{
		$this->load->view(ADMIN_FOLDER.'/reports/PoolAchieversList',$data);  }
		 	 public function clubAchievers()
		{
		$this->load->view(ADMIN_FOLDER.'/reports/clubAchievers',$data);  }
		 
		 
		 
		 		
		  public function performance_bonus() {
		$model = new OperationModel();
		$this->load->view(ADMIN_FOLDER.'/reports/performance_bonus',$data);  }
			 public function performancebonus_List() {
		$model = new OperationModel();
		$this->load->view(ADMIN_FOLDER.'/reports/performance_bonus_List',$data);  }
		 
		
		  public function club_bonus() {
		$model = new OperationModel();
		$this->load->view(ADMIN_FOLDER.'/reports/club_bonus',$data);  }
			 public function clubbonus_List() {
		$model = new OperationModel();
		$this->load->view(ADMIN_FOLDER.'/reports/club_bonus_List',$data);  }
		
	    public function totalincome(){
	    $model = new OperationModel();
	    $this->load->view(ADMIN_FOLDER.'/reports/totalincome',$data); }
		
	   public function totalincomelist(){
	    $model = new OperationModel();
	    $this->load->view(ADMIN_FOLDER.'/reports/totalincomelist',$data); }
		
	 
	    
	 
	
	
}
