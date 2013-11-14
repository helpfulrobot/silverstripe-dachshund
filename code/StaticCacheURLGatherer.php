<?php

class StaticCacheURLGatherer extends Object {

	/**
	 * 
	 * @param SiteTree $page
	 * @return ArrayList
	 */
	public function getPublishURLs(SiteTree $page) {
		return $this->getURLs($page);
	}
	
	/**
	 * 
	 * @param SiteTree $page
	 * @return string|false
	 */
	public function getURL(SiteTree $page) {
		if(!$this->canBeCached($page)) {
			return false;
		}
		$link = new CacheURL();
		$link->url = $page->Link();
		return $link;
	}
	
	/**
	 * 
	 * @param SiteTree $page
	 * @return ArrayList
	 */
	public function getURLs(SiteTree $page) {
		$urls = new ArrayList();
		$link = $this->getURL($page);
		if($link) {
			$urls->push($link);
		}
		while($page->ParentID != 0) {
			$page = $page->Parent();
			$link = $this->getURL($page);
			if($link) {
				$urls->push($link);
			}
		}
		return $urls;
	}

	/**
	 * 
	 * @param SiteTree $page
	 * @return boolean
	 */
	protected function canBeCached(SiteTree $page) {
		if(!$page->canView()) {
			return false;
		}
		return true;
	}
}