/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Streaming;

import Database.MyDb;
import java.sql.Date;
import java.sql.Timestamp;
import org.apache.commons.lang3.StringEscapeUtils;
import twitter4j.StallWarning;
import twitter4j.Status;
import twitter4j.StatusDeletionNotice;
import twitter4j.StatusListener;

/**
 *
 * @author User
 */
public class MyStreaming implements StatusListener{
    MyDb db;
    public MyStreaming(){
        db = new MyDb("root", "", "skripsi", "localhost");
    }
    @Override
            public void onStatus(Status status) {
                
                //System.out.println(status.getId()+" - "+"@" + status.getUser().getName() + " - " + status.getText()+" "+status.getCreatedAt());
                String tweet = StringEscapeUtils.escapeJava(status.getText());
                String split[] = tweet.split("https");
                String res = "";
                
                for (int i = 0; i < split.length; i++) {
                    if (i%2 == 1) {
                        String temp[] = split[i].split(" ");
                        for (int j = 0; j < temp.length; j++) {
                            if (j==0) {
                                res+="<a href='https"+temp[j]+"'> ";
                            }
                            else{
                                res+=temp[j]+" ";
                            }
                        }
                        
                    }
                    else{
                        res+=split[i];
                    }
            
                }
                System.out.println(res);
                //Timestamp timestamp = new Timestamp(status.getCreatedAt().getTime());
                //String sql = "insert into mytweets value("+status.getId()
//                        +",\""+StringEscapeUtils.escapeJava(status.getUser().getName())
//                        +"\",\""+StringEscapeUtils.escapeJava(status.getText())
//                        +"\",0,'"
//                        +timestamp+"')";
                //System.out.println(sql);
                //db.voidStatement(sql);
                
            }

            @Override
            public void onDeletionNotice(StatusDeletionNotice statusDeletionNotice) {
                System.out.println("Got a status deletion notice id:" + statusDeletionNotice.getStatusId());
            }

            @Override
            public void onTrackLimitationNotice(int numberOfLimitedStatuses) {
                System.out.println("Got track limitation notice:" + numberOfLimitedStatuses);
            }

            @Override
            public void onScrubGeo(long userId, long upToStatusId) {
                System.out.println("Got scrub_geo event userId:" + userId + " upToStatusId:" + upToStatusId);
            }

            @Override
            public void onStallWarning(StallWarning warning) {
                System.out.println("Got stall warning:" + warning);
            }

            @Override
            public void onException(Exception ex) {
                ex.printStackTrace();
            }
    
}
