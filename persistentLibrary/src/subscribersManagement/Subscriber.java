/*
 * Class representing a subscriber of a library
 * A subscriber knows his first and last name,
 * his born date and his number in the library
 * @author M.T. Segarra
 * @version 0.0.1
 */
package subscribersManagement;


import java.util.*;

import loansManagement.Loan;
import main.Constraints;
import exceptions.*;

import javax.persistence.*;
import subscribersManagement.Entitled;

/**
 * Entity implementation class for Entity: Subscriber
 *
 */
@Entity
@Inheritance (strategy=InheritanceType.JOINED)
@Table(name="subscribers")
@NamedQuery(name="findAllSubscribers", query="select s from Subscriber s")
public class Subscriber {

	
	/**
	 * @uml.property name="firstName"
	 */
	private String firstName;

	/**
	 * Getter of the property <tt>firstName</tt>
	 * 
	 * @return Returns the firstName.
	 * @uml.property name="firstName"
	 */
	public String getFirstName() {
		return firstName;
	}

	/**
	 * Setter of the property <tt>firstName</tt>
	 * 
	 * @param firstName
	 *            The firstName to set.
	 * @uml.property name="firstName"
	 */
	public void setFirstName(String firstName) {
		this.firstName = firstName;
	}

	/**
	 * @uml.property name="lastName"
	 */
	private String lastName;

	/**
	 * Getter of the property <tt>lastname</tt>
	 * 
	 * @return Returns the lastname.
	 * @uml.property name="lastName"
	 */
	public String getLastName() {
		return lastName;
	}

	/**
	 * Setter of the property <tt>lastname</tt>
	 * 
	 * @param lastname
	 *            The lastname to set.
	 * @uml.property name="lastName"
	 */
	public void setLastName(String lastName) {
		this.lastName = lastName;
	}

	/**
	 * @uml.property name="bornDate"
	 */
	@Transient
	private Calendar bornDate;

	/**
	 * Getter of the property <tt>bornDate</tt>
	 * 
	 * @return Returns the bornDate.
	 * @uml.property name="bornDate"
	 */
	public Calendar getBornDate() {
		return bornDate;
	}

	/**
	 * Setter of the property <tt>bornDate</tt>
	 * 
	 * @param bornDate
	 *            The bornDate to set.
	 * @uml.property name="bornDate"
	 */
	public void setBornDate(Calendar bornDate) {
		this.bornDate = bornDate;
	}

	/** 
	 * @uml.property name="currentLoans"
	 * @uml.associationEnd multiplicity="(0 -1)" ordering="true" inverse="lender:java.util.ArrayList"
	 */
	@Transient
	private ArrayList currentLoans;

	/** 
	 * Getter of the property <tt>currentLoans</tt>
	 * @return Returns the currentLoans.
	 * @uml.property name="currentLoans"
	 */
	public ArrayList getCurrentLoans() {
		return currentLoans;
	}

	/**
	 * Constructor of a subscriber Generates the number of the subscriber
	 * 
	 * @params firstName first name of the subscriber
	 * @params lastName last name of the subscriber
	 * @params bornDate born date of the subscriber
	 * @throws BadParametersException
	 */
	public Subscriber(String firstName, String lastName, Calendar bornDate)
			throws BadParametersException {
		if ((firstName == null) || (lastName == null) || (bornDate == null))
			throw new BadParametersException();
		this.firstName = firstName;
		this.lastName = lastName;
		this.bornDate = bornDate;
//		this.number = numberCreated++;
//		numberCreated++;
		this.currentLoans = new ArrayList<Loan>();
		this.entitles = new ArrayList<Entitled>();
	}

	/*
	 * Decides if the subscriber object (parameter) is the same subscriber as
	 * this one Same first name, last name, and born date
	 * 
	 * @param subscriber object to be compared with this one
	 * 
	 * @return true if parameter object and this one are equal
	 * 
	 * @return false if parameter object is null or different from this one
	 */
	@Override
	public boolean equals(Object subscriber) {
		if (subscriber == null)
			return false;
		Subscriber s = (Subscriber) subscriber;

		if (s.number == number)
			return true;

		if ((s.firstName == null) || (s.lastName == null)
				|| (s.bornDate == null))
			return false;

		if ((this.firstName == null) || (this.lastName == null)
				|| (this.bornDate == null))
			return false;

		boolean res = (s.firstName.equals(firstName))
				&& (s.lastName.equals(lastName))
				&& (s.bornDate.equals(bornDate));

		return res;
	}

	/**
	 * @uml.property name="number"
	 */
	@Id
	@GeneratedValue(strategy = GenerationType.AUTO)
	private long number;

	/**
	 * Getter of the property <tt>number</tt>
	 * 
	 * @return Returns the number.
	 * @uml.property name="number"
	 */
	public long getNumber() {
		return number;
	}

	/**
	 * Setter of the property <tt>number</tt>
	 * 
	 * @param number
	 *            The number to set.
	 * @uml.property name="number"
	 */
	public void setNumber(long number) {
		this.number = number;
	}

	/**
	 * @return true if the subscriber has loans
	 */
	public boolean existingLoans() {
		return currentLoans.size() > 0;
	}

	/**
	 * Add a new loan to the subscriber if quota ok
	 * 
	 * @param loan
	 *            the loan to add to the subscriber
	 * @throws TooManyLoansException
	 * @throws BadParametersException
	 */
	public void lend(Loan loan) throws TooManyLoansException,
			BadParametersException {
		if (loan == null)
			throw new BadParametersException();

		if (!canLend())
			throw new TooManyLoansException();

		currentLoans.add(loan);
	}

	/**
	 * @return true if the subscriber can lend books
	 */
	public boolean canLend() {
		return currentLoans.size() < Constraints.maxLOANS;
	}

	/**
	 * Remove the loan in parameter from the list of current loans of the
	 * subscriber
	 * 
	 * @param loan
	 *            the loan to be finished
	 * @throws BadParametersException
	 * @throws LentBookException
	 *             if loan not found in the list
	 */
	public void returnBook(Loan loan) throws BadParametersException,
			LentBookException {
		if (loan == null)
			throw new BadParametersException();

		if (!currentLoans.remove(loan))
			throw new LentBookException("The lender does not contain the loan");
	}

	/** 
	 * Setter of the property <tt>currentLoans</tt>
	 * @param currentLoans The currentLoans to set.
	 * @uml.property  name="currentLoans"
	 */
	public void setCurrentLoans(ArrayList currentLoans) {
		this.currentLoans = currentLoans;
	}

	/*
	 * Returns a description of the subscriber
	 */
	@Override
	public String toString() {
		return this.getNumber() + " " + this.firstName + ", " + this.lastName;
	}



	public Subscriber(){
	}

	/** 
	 * @uml.property name="entitles"
	 * @uml.associationEnd multiplicity="(0 -1)" ordering="true" inverse="mainSubscriber:subscribersManagement.Entitled"
	 * @uml.association name="subscriberEntitled"
	 */

	@OneToMany(mappedBy = "mainSubscriber")
	private List<Entitled> entitles;

	/**
	 * Getter of the property <tt>entitles</tt>
	 * @return  Returns the entitleds.
	 * @uml.property  name="entitles"
	 */
	public List getEntitles() {
		return this.entitles;
	}

	/**
	 * Setter of the property <tt>entitles</tt>
	 * @param entitles  The entitleds to set.
	 * @uml.property  name="entitles"
	 */
	public void setEntitles(List entitles) {
		this.entitles = entitles;
	}
	
	public void addEntitled(Entitled entitled) {
		this.entitles.add(entitled);
	}
	public void removeEntitled(Entitled entitled) {
		this.entitles.remove(entitled);
	}
	
}
