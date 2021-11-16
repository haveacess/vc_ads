<?php

class AdsController extends Controller {

	public function __construct($request, $data) {
		parent::__construct($request, $data);
	}
	
	/**
	 * Create new ad based on service data
	 *
	 * @return void
	 */
	public function create() {
		$data = $this->request->getData();
		$service = new AdsService($data);

		if (!$service->isValid()) {
			Response::setErrorMessage($service->getError());
			return false;
		}

		if (!$service->create()) {
			Response::setErrorMessage($service->getError());
			return false;
		}

		Response::setSuccessMessage(Message::get('object_was_created'));
	}
	
	/**
	 * Edited existing Ad
	 *
	 * @param  int $id Id Ad which you need to edited
	 * @return void
	 */
	public function edit($id) {
		$data = $this->request->getData();
		$service = new AdsService($data);

		if (!$service->isValid()) {
			Response::setErrorMessage($service->getError());
			return false;
		}

		if (!$service->getAd($data['id'])) {
			Response::setErrorMessage($service->getError());
			return false;
		}

		$editedAd = $service->editAd($data['id']);

		$editedAd ?
			Response::setSuccessMessage(Message::get('object_was_edited'), $editedAd) :
			Response::setErrorMessage($service->getError());
	}
		
	/**
	 * Receive first relevant Ad based on alghoritm:
	 * Documentation: link
	 *
	 * @return void
	 */
	public function relevant() {
		$service = new AdsService();
		$ad = $service->getRelevantAd();

		$ad ?
			Response::setSuccessMessage(Message::get('message_ok'), $ad) :
			Response::setErrorMessage($service->getError());
	}
}