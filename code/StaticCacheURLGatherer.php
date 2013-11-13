<?php

class StaticCacheURLGatherer extends Object {
	
	/**
	 * 
	 * @param SiteTree $page
	 * @return string|false
	 */
	public function getURL(SiteTree $page) {
		$oldMode = Versioned::get_reading_mode();
		if(!$this->shouldBeCached($page)) {
			return false;
		}
		return $page->Link();
	}
	
	/**
	 * 
	 * @param SiteTree $page
	 */
	public function getURLs(SiteTree $page) {
		$urls = array();
		$link = $this->getURL($page);
		if($link) {
			$urls[] = $link;
		}
		while($page->ParentID != 0) {
			$page = $page->Parent();
			$link = $this->getURL($page);
			if($link) {
				$urls[] = $link;
			}
		}
		return $urls;
	}

	/**
	 * 
	 * @param SiteTree $page
	 * @return boolean
	 */
	protected function shouldBeCached(SiteTree $page) {
		if(!$page->canView()) {
			return false;
		}
		return true;
	}
}