<?php

class AdsService extends Service {

	CONST FORMAT_TEXT = '/[a-zA-Z,.?!\s\d]/m';
	CONST FORMAT_DIGITS_ONLY = '/^[\d]+$/m';
	CONST FORMAT_DIGITS_DEC_2 = '/^[\d]{0,}(\.[\d]{0,2})?$/m'; //decimal part is optional
	CONST FORMAT_LINK = '/http(s)?:\/\/(.*)\.(.*)/m';
	
	public function __construct($data=[]) {
		parent::__construct($data);
	}
	
	/**
	 * Validate received fields
	 *
	 * @return bool
	 */
	public function isValid() {
		$fields = [
			[
				'name' => 'text',
				'isRequired' => true,
				'pattern' => self::FORMAT_TEXT
			],
			[
				'name' => 'price',
				'isRequired' => true,
				'pattern' => self::FORMAT_DIGITS_DEC_2,
			],
			[
				'name' => 'limit_views',
				'isRequired' => true,
				'pattern' => self::FORMAT_DIGITS_ONLY
			],
			[
				'name' => 'banner',
				'isRequired' => true,
				'pattern' => self::FORMAT_LINK
			]
		];

		foreach ($fields as $rule) {
			$name = $rule['name'];

			if ($rule['isRequired'] && empty($this->data[$name])) {
				$this->setError(sprintf(Message::get('field_is_required'), $name));
				return false;
			}

			if ($rule['pattern'] && !preg_match($rule['pattern'], $this->data[$name])) {
				$this->setError(sprintf(Message::get('field_is_invalid'), $name));
				return false;
			}
		}

		return true;
	}
	
	/**
	 * Get ad by id
	 *
	 * @param  string $id ID ad
	 * @return array|false
	 */
	public function getAd($id) {
		$model = new AdsModel();
		$result = $model->selectByPrimary(['id', 'text', 'price', 'limit_views', 'banner'], $id);

		if ($result === []) {
			$this->setError(Message::get('object_not_found'));
			return false;
		}

		if ($result === false) {
			$this->setError(Message::get('general_error'));
			return false;
		}

		return $result;
	}

	/**
	 * Edit ad by id
	 *
	 * @param  string $id ID ad
	 * @return array|false
	 */
	public function editAd($id) {
		$model = new AdsModel();
		$result = $model->update([
			'id' => null,
			'text' => $this->data['text'],
			'price' => (int)$this->data['price'],
			'limit_views' => (int)$this->data['limit_views'],
			'banner' => $this->data['banner'],
		], $id);

		if (!$result) {
			$this->setError(Message::get('general_error'));
			return false;
		}

		return $this->data;
	}

	/**
	 * Create new add
	 *
	 * @return bool
	 */
	public function create() {
		$model = new AdsModel();
		$result = $model->insert([
			'id' => null,
			'text' => $this->data['text'],
			'price' => (int)$this->data['price'],
			'limit_views' => (int)$this->data['limit_views'],
			'banner' => $this->data['banner'],
		]);

		if (!$result) {
			$this->setError(Message::get('general_error'));
			return false;
		}

		return true;
	}
	
	/**
	 * Receive relevant ad
	 *
	 * @return array|false
	 */
	public function getRelevantAd() {
		$model = new AdsModel();
		$result = $model->getRelevant(true);

		if ($result === false) {
			$this->setError(Message::get('general_error'));
			return false;
		}

		return $result;
	}
}