import java.net.*;
import java.io.*;
import java.util.Arrays;
import java.util.List;
import java.util.ArrayList;

//from a tutorial at http://docs.oracle.com/javase/tutorial/networking/urls/readingWriting.html

//This class connects to one or more URLs passed as arguments
//It then outputs the entrie HTML source of these URLs to stdout
//Output for a URL always starts with an HTML comment:
//<!--Here begins url (url) -->
public class URLConnectionReader {
  public static void main(String[] args) throws Exception {
    ArrayList urls = new ArrayList(Arrays.asList(args));
    for (int i = 0; i < urls.size(); i++) {
      URL urlToRead = new URL(args[i]);
      URLConnection yc = urlToRead.openConnection();
      BufferedReader in = new BufferedReader(new InputStreamReader(yc.getInputStream()));
      String inputLine;
      System.out.println("<!--Here begins url " + args[i] + "-->");
      while ((inputLine = in.readLine()) != null)
        System.out.println(inputLine);
      in.close();
    }

    if (urls.size() == 0)
      System.out.println("Please pass at least one  url\n");

  }
}
