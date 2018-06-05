package com.arjun.qbapp.test;

import java.sql.Connection;
import java.sql.DriverManager;

public class Test {

	public static void main(String[] args) {
		
		try {
			String jdbcUrl = "jdbc:mysql://localhost:3306/qb_app_master?useSSL=false";
			String userName = "arjunmaster";
			String password = "arjunmaster";
			
			Connection myCon = DriverManager.getConnection(jdbcUrl, userName, password);
			
			System.out.println("connection succesful");
			
		}
		catch(Exception exp) {
			
			System.out.println("poseidon inside JDBC exception"+exp.getMessage());
		}

	}

}
