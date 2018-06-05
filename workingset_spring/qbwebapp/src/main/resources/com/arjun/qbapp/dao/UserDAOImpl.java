package com.arjun.qbapp.dao;

import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.arjun.qbapp.entity.UserMaster;

@Repository
public class UserDAOImpl implements UserDAO {
	
	@Autowired
	private SessionFactory sessionFactory;

	public UserMaster getUser(int Id) {
		
		Session currentSession = sessionFactory.getCurrentSession();
		
		UserMaster user = currentSession.get(UserMaster.class, Id);
		
		return user;
	}
	
	

}
