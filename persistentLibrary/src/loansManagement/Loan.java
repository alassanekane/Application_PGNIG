/*
 * Class representing a loan of a book by a subscriber
 * @author M.T. Segarra
 * @version 0.0.1
 */
package loansManagement;


import java.util.Calendar;
import java.util.GregorianCalendar;

import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.IdClass;
import javax.persistence.NamedQuery;
import javax.persistence.Table;

import main.Constraints;
import subscribersManagement.Subscriber;
import booksManagement.Book;
import exceptions.BadParametersException;
import exceptions.LentBookException;
import exceptions.TooManyLoansException;

@Entity
@IdClass(LoanPK.class)
@Table(name="loans")
@NamedQuery(name="findAllLoans", query="select l from Loan l")
public class Loan {

		
	/**
	 * @uml.property  name="returnDate"
	 */
	@Id private Calendar returnDate;

	/**
	 * Getter of the property <tt>returnDate</tt>
	 * @return  Returns the returnDate.
	 * @uml.property  name="returnDate"
	 */
	 public Calendar getReturnDate() {
		return returnDate;
	}

	/**
	 * Setter of the property <tt>returnDate</tt>
	 * @param returnDate  The returnDate to set.
	 * @uml.property  name="returnDate"
	 */
	public void setReturnDate(Calendar returnDate) {
		this.returnDate = returnDate;
	}

	
	/** 
	 * @uml.property name="book"
	 * @uml.associationEnd inverse="loan:booksManagement.Book"
	 */
	
	@Id private Book book;

	/** 
	 * Getter of the property <tt>book</tt>
	 * @return  Returns the book.
	 * @uml.property  name="book"
	 */
	
	 public Book getBook() {
		return book;
	}

	/** 
	 * Setter of the property <tt>book</tt>
	 * @param book  The book to set.
	 * @uml.property  name="book"
	 */
	public void setBook(Book book) {
		this.book = book;
	}
	/**
	 * Construteur Vide pour la persistance de la class. 
	 */
	public Loan() {}
	
	/**
	 * Creates the loan of book for lender
	 * Constraints checking is performed by the caller
	 * @param book the book to be lent
	 * @param lender the subscriber 
	 * @throws BadParametersException 
	 * @throws TooManyLoansException 
	 * @throws LentBookException 
	 */
	public Loan(Book book, Subscriber lender) throws BadParametersException, 
	TooManyLoansException, LentBookException{
		if ((book == null) || (lender == null))
			throw new BadParametersException();
		
		this.book = book;
		this.lender = lender;
		Calendar rDate = new GregorianCalendar();
		rDate.add(Calendar.MONTH, Constraints.loanDELAY);
		this.returnDate = rDate;
		
		// Update the subscriber if he can lend
		lender.lend(this);
		
		// Update the book if not already lent
		book.lend(this);
	}

	/**
	 * Two loans are equal is they concern the same book
	 * the same lender and return date
	 * @return true if the current loan is the same as the parameter
	 */
	@Override
	public boolean equals(Object loan){
		if (loan == null)
			return false;
		Loan l = (Loan)loan;
		boolean res = this.book.equals(l.book) 
			&& this.lender.equals(l.lender) 
			&& (this.returnDate.equals(l.returnDate));
		return res;	
	}

		
	/**
	 * Called by the lent book
	 * Clear all the information contained in this loan
	 * if the lender is ok
	 * @throws BadParametersException 
	 * @throws LentBookException 
	 */
	public void returnBook() throws BadParametersException, 
	LentBookException{
				
		// Ask the lender to return the book
		lender.returnBook(this);
		// Clear lender, book, and return date
		lender = null;
		book = null;
		returnDate = null;
	}


	/**
	 * @uml.property  name="lender"
	 * @uml.associationEnd  inverse="currentLoans:subscribersManagement.Subscriber"
	 */
	
	@Id private Subscriber lender;

	/**
	 * Getter of the property <tt>lender</tt>
	 * @return  Returns the lender.
	 * @uml.property  name="lender"
	 */
	 public Subscriber getLender() {
		return lender;
	}

	/**
	 * Setter of the property <tt>lender</tt>
	 * @param lender  The lender to set.
	 * @uml.property  name="lender"
	 */
	public void setLender(Subscriber lender) {
		this.lender = lender;
	}
	
	
}



