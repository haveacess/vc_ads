<?php

class AdsModel extends Model {
	protected $table = 'ads';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct($this->table);
	}
	
	/**
	 * Receive relevant ad
	 *
	 * @param  bool $decrementViews (opt.) Always when you triggered this method views will be decrement on 1 point in database
	 * @return array|false Relevant ad
	 */
	public function getRelevant($decrementViews=true) { 
		$ad = $this->getQueryResult(
			"select id,text, banner 
			from ads
			where ads.limit_views > 0
			order by (ads.price*ads.limit_views) desc
			LIMIT 0,1");

		if ($ad && $decrementViews) {
			$query = "UPDATE %s  SET %s=%s - 1 WHERE %s=%s and %s > %s";
			
			$this->getQueryResult(vsprintf($query, [
				$this->table,
				'limit_views',
				'limit_views',
				$this->primaryKey,
				self::getFormattedValue($ad[$this->primaryKey]),
				'limit_views',
				0
			]), true);
		}	

		return $ad;
	}
}