import java.sql.*;

import java.util.*;
import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;


/**
 *
 */
public class JavaSqlExample {
  public static void main(String args[]) {
    try {
      // Loads the class "oracle.jdbc.driver.OracleDriver" into the memory
      Class.forName("oracle.jdbc.driver.OracleDriver");
 
      // Connection details
      String database = "*";
      String user = "*";
      String pass = "*";
 
      // Establish a connection to the database
      Connection con = DriverManager.getConnection(database, user, pass);
      Statement stmt = con.createStatement();

      try{
        BufferedReader bufferedReader = new BufferedReader(
                new FileReader("appcomment.txt")
        );
        String line;

        int i = 1;
        while (i < 50)
        {
          if((line = bufferedReader.readLine()) != null){
            int rowsAffected = stmt.executeUpdate(line.toString());
            i++;
          }
        }
      }
      catch (FileNotFoundException e){
        e.printStackTrace();
      }
      catch (IOException e){
        e.printStackTrace();
      }

      ResultSet rs = stmt.executeQuery("SELECT COUNT (*) FROM appcomment");
      if (rs.next()) {
        int count = rs.getInt(1);
        System.out.println("Number of datasets: " + count);
      }

      try{
        BufferedReader bufferedReader = new BufferedReader(
                //new FileReader("appuser.txt")
                new FileReader("appuser2.txt")
        );
        String line;
        while ((line = bufferedReader.readLine()) != null)
        {
          int rowsAffected = stmt.executeUpdate(line.toString());
        }
      }
      catch (FileNotFoundException e){
        e.printStackTrace();
      }
      catch (Exception e) {
        System.err.println("Error while executing INSERT INTO statement: " + e.getMessage());
      }

      rs = stmt.executeQuery("SELECT COUNT (*) FROM appuser");
      if (rs.next()) {
        int count = rs.getInt(1);
        System.out.println("Number of datasets: " + count);
      }

      rs = stmt.executeQuery("INSERT INTO author SELECT * FROM appuser");

      rs = stmt.executeQuery("INSERT INTO follower SELECT * FROM appuser");

      rs = stmt.executeQuery("SELECT COUNT (*) FROM author");
      if (rs.next()) {
        int count = rs.getInt(1);
        System.out.println("Number of datasets: " + count);
      }

      rs = stmt.executeQuery("SELECT COUNT (*) FROM follower");
      if (rs.next()) {
        int count = rs.getInt(1);
        System.out.println("Number of datasets: " + count);
      }

      rs = stmt.executeQuery("SELECT COUNT (*) FROM contains");
      if (rs.next()) {
        int count = rs.getInt(1);
        System.out.println("Number of datasets: " + count);
      }

      try{
        BufferedReader bufferedReader = new BufferedReader(
                new FileReader("contains.txt")
        );
        String line;

        int i = 1;
        while (i < 100)
        {
          if((line = bufferedReader.readLine()) != null){
            //stmt.executeQuery("INSERT INTO post (authorUsername) SELECT author.username FROM author WHERE author.userId = " + i);
            int rowsAffected = stmt.executeUpdate(line.toString());
            i++;
          }
        }
      }
      catch (FileNotFoundException e){
        e.printStackTrace();
      }
      catch (Exception e) {
        System.err.println("Error while executing INSERT INTO statement: " + e.getMessage());
      }

      rs = stmt.executeQuery("SELECT COUNT (*) FROM contains");
      if (rs.next()) {
        int count = rs.getInt(1);
        System.out.println("Number of datasets: " + count);
      }

      try{
        BufferedReader bufferedReader = new BufferedReader(
                //new FileReader("follow.txt")
                //new FileReader("follow-2.txt")
                new FileReader("follow-3.txt")
        );
        String line;

        while ((line = bufferedReader.readLine()) != null)
        {
          //sb.append(line);
          int rowsAffected = stmt.executeUpdate(line.toString());
        }
      }
      catch (FileNotFoundException e){
        e.printStackTrace();
      }
      catch (Exception e) {
        System.err.println("Error while executing INSERT INTO statement: " + e.getMessage());
      }

      rs = stmt.executeQuery("SELECT COUNT (*) FROM follow");
      if (rs.next()) {
        int count = rs.getInt(1);
        System.out.println("Number of datasets: " + count);
      }

      try{
        BufferedReader bufferedReader = new BufferedReader(
                new FileReader("likepost.txt")
        );
        String line;
        while ((line = bufferedReader.readLine()) != null)
        {
          int rowsAffected = stmt.executeUpdate(line.toString());
        }
      }
      catch (FileNotFoundException e){
        e.printStackTrace();
      }
      catch (Exception e) {
        System.err.println("Error while executing INSERT INTO statement: " + e.getMessage());
      }

      rs = stmt.executeQuery("SELECT COUNT (*) FROM likepost");
      if (rs.next()) {
        int count = rs.getInt(1);
        System.out.println("Number of datasets: " + count);
      }

      try{
        BufferedReader bufferedReader = new BufferedReader(
                new FileReader("likes.txt")
        );
        String line;
        while ((line = bufferedReader.readLine()) != null)
        {
          int rowsAffected = stmt.executeUpdate(line.toString());
        }
      }
      catch (FileNotFoundException e){
        e.printStackTrace();
      }
      catch (Exception e) {
        System.err.println("Error while executing INSERT INTO statement: " + e.getMessage());
      }

      rs = stmt.executeQuery("SELECT COUNT (*) FROM likes");
      if (rs.next()) {
        int count = rs.getInt(1);
        System.out.println("Number of datasets: " + count);
      }

      try{
        BufferedReader bufferedReader = new BufferedReader(
                new FileReader("media.txt")
        );
        String line;
        while ((line = bufferedReader.readLine()) != null)
        {
          int rowsAffected = stmt.executeUpdate(line.toString());
        }
      }
      catch (FileNotFoundException e){
        e.printStackTrace();
      }
      catch (Exception e) {
        System.err.println("Error while executing INSERT INTO statement: " + e.getMessage());
      }

      rs = stmt.executeQuery("SELECT COUNT (*) FROM media");
      if (rs.next()) {
        int count = rs.getInt(1);
        System.out.println("Number of datasets: " + count);
      }

      try{
        BufferedReader bufferedReader = new BufferedReader(
                new FileReader("post.txt")
        );
        String line;

        int i = 1;
        while (i < 100)
        {
          if((line = bufferedReader.readLine()) != null){
            int rowsAffected = stmt.executeUpdate(line.toString());
            i++;
          }
        }
      }
      catch (FileNotFoundException e){
        e.printStackTrace();
      }
      catch (Exception e) {
        System.err.println("Error while executing INSERT INTO statement: " + e.getMessage());
      }

      rs = stmt.executeQuery("SELECT COUNT (*) FROM post");
      if (rs.next()) {
        int count = rs.getInt(1);
        System.out.println("Number of datasets: " + count);
      }

      // Clean up connections
      rs.close();
      stmt.close();
      con.close();
    } catch (Exception e) {
      System.err.println(e.getMessage());
    }

  }
}