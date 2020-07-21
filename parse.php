<?php

include('date_helper.php');
include('Connection.php');
set_time_limit(0);


function getData($cursor=''){

    $database=new Connection();
    $db=$database->openConnection();

    date_default_timezone_set("Asia/Baku");
    $now=date('Y-m-d H:i');
    $before_one_week=date('Y-m-d H:i',strtotime('-1 week',strtotime($now)));

    $data=file_get_contents('https://oxu.az/?'.$cursor);
    preg_match_all('@<div class="title">(.*?)</div>@si',$data,$title);
    $title=$title[1];

    preg_match_all('/<a class="more" rel="next" data-remote="true" href=\"([^\"]*)\">(.*)<\/a>/iU',$data,$cursor_data);


    preg_match_all('@<div class="date-year">(.*?)</div>@si',$data,$date_year);
    $date_year=$date_year[1];
    preg_match_all('@<div class="date-day">(.*?)</div>@si',$data,$date_day);
    $date_day=$date_day[1];
    preg_match_all('@<div class="date-month">(.*?)</div>@si',$data,$date_month);
    $date_month=$date_month[1];
    preg_match_all('@<div class="when-time">(.*?)</div>@si',$data,$hour);
    $hour=$hour[1];

    $cursor_value=ltrim($cursor_data[1][0],'/?cursor='); //1595263380 tipli eded
    $count_data=count($title);

    preg_match_all('~<a target="_blank" class="news-i-inner" (.*?)href="([^"]+)"(.*?)>~',$data,$detail_news_data);


//
    for ($i=0;$i<$count_data;$i++){

        sleep(2);
        
        $news_date=date('Y-m-d H:i',strtotime($date_year[$i].month_row($date_month[$i]).day_to_string($date_day[$i]).' '.$hour[$i]));

        if ($before_one_week>=$news_date){
            $database->closeConnection();
            die('Bitdi');
        }

        $news_id=explode('/',$detail_news_data[2][$i])[2];
        $news_category=explode('/',$detail_news_data[2][$i])[1];

        $data_detail=file_get_contents('https://oxu.az/'.$news_category.'/'.$news_id);

        if (!$data_detail){
            $database->closeConnection();
            die('error');
        }

        $content = explode( '<div class="news-inner">' , $data_detail);
        $content = explode("</div>" , $content[1] );
        $content=preg_replace('#<script(.*?)>(.*?)</script>#is', '', $content);
        $content=strip_tags($content[1]);


        preg_match('@<div class="stats-i-container stats-like-active stats_likes" (.*?)><span class="stats-i">(.*?)</span></div>@si',$data_detail,$news_likes);
        $news_likes=$news_likes[2];

        preg_match('@<div class="stats-i-container stats-like-active stats_dislikes" (.*?)><span class="stats-i">(.*?)</span></div>@si',$data_detail,$news_dislikes);
        $news_dislikes=$news_dislikes[2];

        preg_match('@<div class="stats-i-container stats_views"><span class="stats-i">(.*?)</span></div>@si',$data_detail,$news_view_count);
        $news_view_count=$news_view_count[1];

        preg_match('~<img (.*?) class="news-img" (.*?)src="([^"]+)"(.*?)>~',$data_detail,$news_image);
        $news_image=$news_image[3];



        $category_row = $db->prepare('SELECT * FROM categories WHERE name=?');
        $category_row->execute([$news_category]);
        $category_row = $category_row->fetch();

        if( ! $category_row)
        {
            $insert_category= $db->prepare("INSERT INTO categories (name) VALUES (?)");
            $insert_category->execute([$news_category]);
            $category_id=$db->lastInsertId();
        }else{
            $category_id=$category_row['id'];
        }


        $news_row = $db->prepare('SELECT * FROM news WHERE news_id=?');
        $news_row->execute([$news_id]);
        $news_row = $news_row->fetch();

        if( ! $news_row)
        {
            $insert_news= $db->prepare("INSERT INTO news (news_id,category_id,title,content,likes,dislikes,view_count,image,date) VALUES (?,?,?,?,?,?,?,?,?)");
            $insert_news->execute([$news_id,$category_id,$title[$i],$content,$news_likes,$news_dislikes,$news_view_count,$news_image,$news_date]);
        }else{
            $update_news = "UPDATE news SET category_id=?, title=?, content=? , likes=? , dislikes=? , view_count=? , image=? , date=? WHERE news_id=?";
            $db->prepare($update_news)->execute([$category_id,$title[$i],$content,$news_likes,$news_dislikes,$news_view_count,$news_image,$news_date,$news_id]);
        }

    }

    getData('cursor='.$cursor_value);

}

getData();


