package com.arjun.qbapp.entity;

import java.sql.Date;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.Table;

@Entity
@Table(name = "usermaster")
public class UserMaster {
	@Id
	@GeneratedValue(strategy=GenerationType.IDENTITY)
	@Column(name="ID")
	private int ID;
	
	@Column(name="emailid")
	private String emailId;
	
	@Column(name="ctpassword")
	private String ctPassword;
	
	@Column(name="usertype")
	private String userType;
	
	@Column(name="userstatus")
	private Character userStatus;
	
	@Column(name="activationkey")
	private String activationKey;
	
	@Column(name="dateofcreation")
	private Date dateOfCreation;
	
	@Column(name="dateofactivation")
	private Date dateOfActivation;
	
	/*
	 * `ID` bigint(20) NOT NULL AUTO_INCREMENT, `emailid` varchar(500) DEFAULT NULL,
	 * `ctpassword` varchar(500) DEFAULT NULL, `usertype` varchar(200) DEFAULT NULL,
	 * `userstatus` char(1) DEFAULT NULL, `activationkey` varchar(500) DEFAULT NULL,
	 * `dateofcreation` datetime DEFAULT NULL, `dateofactivation` datetime DEFAULT
	 * NULL,
	 */

	public UserMaster() {

	}

	public UserMaster(String emailId, String ctPassword, String userType, Character userStatus, String activationKey,
			Date dateOfCreation, Date dateOfActivation) {
		super();
		this.emailId = emailId;
		this.ctPassword = ctPassword;
		this.userType = userType;
		this.userStatus = userStatus;
		this.activationKey = activationKey;
		this.dateOfCreation = dateOfCreation;
		this.dateOfActivation = dateOfActivation;
	}

	public String getEmailId() {
		return emailId;
	}

	public void setEmailId(String emailId) {
		this.emailId = emailId;
	}

	public String getCtPassword() {
		return ctPassword;
	}

	public void setCtPassword(String ctPassword) {
		this.ctPassword = ctPassword;
	}

	public String getUserType() {
		return userType;
	}

	public void setUserType(String userType) {
		this.userType = userType;
	}

	public Character getUserStatus() {
		return userStatus;
	}

	public void setUserStatus(Character userStatus) {
		this.userStatus = userStatus;
	}

	public String getActivationKey() {
		return activationKey;
	}

	public void setActivationKey(String activationKey) {
		this.activationKey = activationKey;
	}

	public Date getDateOfCreation() {
		return dateOfCreation;
	}

	public void setDateOfCreation(Date dateOfCreation) {
		this.dateOfCreation = dateOfCreation;
	}

	public Date getDateOfActivation() {
		return dateOfActivation;
	}

	public void setDateOfActivation(Date dateOfActivation) {
		this.dateOfActivation = dateOfActivation;
	}

}

