package Database;



import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 *
 * @author User
 */
public class MyDb {

    private Connection conn;

    public MyDb(String id, String password, String database, String domain) {
        try {
            conn = (Connection) DriverManager.getConnection("jdbc:mysql://" + domain + "/" + database + "?"
                    + "user=" + id + "&password=" + password + "");
        } catch (SQLException ex) {
            System.err.println(ex.getMessage());
        }
    }

    /**
     * Untuk melakukan eksekusi pada query yang tidak memiliki kembalian
     * @param query 
     */
    public void voidStatement(String query) {
        boolean res = false;
        try {
            PreparedStatement ps = conn.prepareStatement(query);
            ps.execute();
            res = true; 
        } catch (SQLException ex) {
            System.err.println(ex.getMessage());
        }
    }
    /**
     * Untuk melakukan eksekusi pada query yang memiliki kembalian
     * @param sql
     * @return 
     */
    public ArrayList<Object[]> returnStatement(String sql) {
        Statement st;
        ResultSet rs = null;
        ArrayList<Object[]> res = null;
        try {
            st = conn.createStatement();
            rs = st.executeQuery(sql);
            int n = rs.getMetaData().getColumnCount();
            res = new ArrayList<Object[]>();

            int j = 0;
            while (rs.next()) {
                Object[] values = new Object[n];
                for (int i = 1; i <= n; i++) {
                    values[i - 1] = rs.getObject(i);
                }
                res.add(values);
            }
        } catch (SQLException ex) {
            System.err.println(ex.getMessage());
        }
        return res;
    }
}
