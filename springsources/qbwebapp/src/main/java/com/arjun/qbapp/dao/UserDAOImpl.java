package com.arjun.qbapp.dao;

import javax.sql.DataSource;

import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.arjun.qbapp.entity.UserMaster;

@Repository
public class UserDAOImpl implements UserDAO {
	
	@Autowired	
	private SessionFactory sessionFactory;
	@Autowired
	private DataSource dataSource;
	
	@Override
	public UserMaster getUser(int Id) {
		System.out.println("session factory inside the dao"+sessionFactory);
		System.out.println("data source inside the dao"+dataSource);
		
		 Session currentSession = this.sessionFactory.getCurrentSession();
		
		UserMaster user = currentSession.get(UserMaster.class, Id);
		
		return user;
	}
	
	

}
