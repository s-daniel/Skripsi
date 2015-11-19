/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Streaming;

import org.apache.commons.lang3.StringEscapeUtils;
import twitter4j.FilterQuery;
import twitter4j.Query;
import twitter4j.QueryResult;
import twitter4j.Status;
import twitter4j.Twitter;
import twitter4j.TwitterException;
import twitter4j.TwitterFactory;
import twitter4j.TwitterStream;
import twitter4j.TwitterStreamFactory;

/**
 *
 * @author User
 */
public class Main {
    public static void main(String[] args) throws TwitterException {
        TwitterStream twitterStream = new TwitterStreamFactory().getSingleton();
        MyStreaming listener = new MyStreaming();
        twitterStream.addListener(listener);
        FilterQuery fq = new FilterQuery();
        fq.language("in");
        
        String[] keywordsArray = { "bandung" };
        fq.track(keywordsArray);
        twitterStream.filter(fq);
//        Twitter twitter = TwitterFactory.getSingleton();
//        Query query = new Query("bandung OR lalinbandung");
//        query.setCount(1000);
//        query.lang("in");
//        
//        QueryResult result = twitter.search(query);
//        
//        for (Status status : result.getTweets()) {
//            System.out.println(status.getCreatedAt()+" @" + status.getUser().getScreenName() + ":" + status.getText());
//        }
    }
}
