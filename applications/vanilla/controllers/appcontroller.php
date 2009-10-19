<?php if (!defined('APPLICATION')) exit();

class VanillaController extends Gdn_Controller {
   
   public function Initialize() {
      if ($this->DeliveryType() == DELIVERY_TYPE_ALL) {
         $this->Head = new HeadModule($this);
         $this->AddJsFile('js/library/jquery.js');
         $this->AddJsFile('js/library/jquery.livequery.js');
         $this->AddJsFile('js/library/jquery.form.js');
         $this->AddJsFile('js/library/jquery.popup.js');
         $this->AddJsFile('js/library/jquery.menu.js');
         $this->AddJsFile('js/library/jquery.gardenhandleajaxform.js');
         $this->AddJsFile('js/global.js');
      }
      
      $this->AddCssFile('menu.css');
      $this->AddCssFile('popup.css');
      $GuestModule = new GuestModule($this);
      $GuestModule->MessageCode = "It looks like you're new here. If you want to take part in the discussions, click one of these buttons!";
      $this->AddModule($GuestModule);
      $this->AddModule('PoweredByVanillaModule');
      parent::Initialize();
   }
   
   public function AddSideMenu($CurrentUrl) {
      // Only add to the assets if this is not a view-only request
      if ($this->_DeliveryType == DELIVERY_TYPE_ALL) {
         $SideMenu = new Gdn_SideMenuModule($this);
         $SideMenu->HtmlId = '';
         $this->EventArguments['SideMenu'] = &$SideMenu;
         $this->FireEvent('GetAppSettingsMenuItems');
         $this->AddModule($SideMenu, 'Panel');
      }
   }
}