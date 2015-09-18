<?php

/**
 * Class ThirdPartyController abstract superclass for third-party service authorization
 */
abstract class ThirdPartyController extends Zend_Controller_Action {

    /**
     * @var string base url and port for redirection
     */
    protected $_baseUrl;

    /**
     * @var Application_Service_ThirdPartyService third party service object
     */
    protected $_service;

    /**
     * @var string Application_Model_Preference service request token accessor function name
     */
    protected $_SERVICE_TOKEN_ACCESSOR;

    /**
     * Disable controller rendering and initialize
     */
    public function init() {
        $CC_CONFIG = Config::getConfig();
        $this->_baseUrl = 'http://' . $CC_CONFIG['baseUrl'] . ":" . $CC_CONFIG['basePort'] . "/";

        $this->view->layout()->disableLayout();  // Don't inject the standard Now Playing header.
        $this->_helper->viewRenderer->setNoRender(true);  // Don't use (phtml) templates
    }

    /**
     * Upload the file with the given id to a third-party service
     *
     * @return void
     *
     * @throws Zend_Controller_Response_Exception thrown if upload fails for any reason
     */
    public function uploadAction() {
        $request = $this->getRequest();
        $id = $request->getParam('id');
        $this->_service->upload($id);
    }

    /**
     * Download the file with the given id from a third-party service
     *
     * @return void
     *
     * @throws Zend_Controller_Response_Exception thrown if download fails for any reason
     */
    public function downloadAction() {
        $request = $this->getRequest();
        $id = $request->getParam('id');
        $this->_service->download($id);
    }

    /**
     * Delete the file with the given id from a third-party service
     *
     * @return void
     *
     * @throws Zend_Controller_Response_Exception thrown if deletion fails for any reason
     */
    public function deleteAction() {
        $request = $this->getRequest();
        $id = $request->getParam('id');
        $this->_service->delete($id);
    }

}