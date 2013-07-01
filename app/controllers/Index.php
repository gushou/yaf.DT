<?php
/**
 * 首页
 */
class IndexController extends Controller {

    /**
     * @var models_tag
     */
    private $model_tag;
    /**
     * @var models_items
     */
    private $model_items;
    /**
     * @var models_reply
     */
    private $model_reply;
    /**
     * @var models_album
     */
    private $model_album;

	public function init() {
		parent::init();
		$this->setaction('index');

        $this->model_tag = models_tag::getInstance();
        $this->model_items = models_items::getInstance();
        $this->model_reply = models_reply::getInstance();
        $this->model_album = models_album::getInstance();
	}

	public function indexAction() {
        $tags = $this->model_tag->getTags();
        $this->set('tags',$tags);

        $items = $this->model_items->getIndexItems();
//        $items_ids = helper_common::get_column($items,'items_id');
//        $replys = $this->model_reply->getAllByItemIds($items_ids);

        foreach($items as $v){
            $replys[$v['items_id']] = $this->model_reply->getAllByItemId($v['items_id']);
        }

        $my_albums = $this->model_album->myAlbum();
        $hot_albums = $this->model_album->hotAlbum();

        $this->set('items', $items);
        $this->set('replys', $replys);
        $this->set('myalbums', $my_albums);
        $this->set('hotalbums', $hot_albums);
	}

}