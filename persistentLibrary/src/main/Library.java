package main;

/*
 * Class offering the main functions of the library
 * @author M.T. Segarra
 * @version 0.0.1
 */

import java.util.*;

import loansManagement.Loan;
import subscribersManagement.Subscriber;
import booksManagement.Book;
import exceptions.*;
import subscribersManagement.SubscriberDAO;
import booksManagement.BookDAO;
import loansManagement.LoanDAO;



public class Library {
	
	/**
	 * @uml.property   name="loans"
	 * @uml.associationEnd   inverse="library:loansManagement.LoanDAO"
	 * @uml.association   name="loans"
	 */
	private final LoanDAO loans = new LoanDAO();
	
	/**
	 * @uml.property   name="books"
	 * @uml.associationEnd   inverse="library:booksManagement.BookDAO"
	 * @uml.association   name="books"
	 */
	private BookDAO books=new BookDAO();

	/**
	 * @uml.property   name="subscribers"
	 * @uml.associationEnd   inverse="library:subscribersManagement.SubscriberDAO"
	 * @uml.association   name="subscribers"
	 */
	private SubscriberDAO subscribers=new SubscriberDAO();

	/**
	 * Getter of the property <tt>books</tt>
	 * @return  Returns the libraryBooks.
	 * @uml.property  name="books"
	 */
	public BookDAO getBooks() {
		return books;
	}
	
	
	
	/**
	 * Getter of property <tt>loans<tt>
	 * 
	 * @return Returns the loans
	 * @uml.property name="loans"
	 */
	public LoanDAO getLoans() {
		return loans;
	}




	/**
	 * Setter of the property <tt>books</tt>
	 * @param books  The libraryBooks to set.
	 * @uml.property  name="books"
	 */
	public void setBooks(BookDAO books) {
		books = books;
	}

	/**
	 * A utility method to know if a book is already in the library
	 * 
	 * @param book to
	 * @return false if the book not known by the library
	 * @return true if the book is known by the library
	 */
	private boolean isABook(Book book) throws BadParametersException, BookExistsException {
		if (book == null)
			throw new BadParametersException();
		
		// If the object is in the list,
		// it is a known book
		return books.contains(book);
	}

	/**
	 * Getter of the property <tt>subscribers</tt>
	 * @return  Returns the librarySubscribers.
	 * @uml.property  name="subscribers"
	 */
	public SubscriberDAO getSubscribers() {
		return subscribers;
	}

	/**
	 * Setter of the property <tt>subscribers</tt>
	 * @param subscribers  The librarySubscribers to set.
	 * @uml.property  name="subscribers"
	 */
	public void setSubscribers(SubscriberDAO subscribers) {
		subscribers = subscribers;
	}

	/**
	 * A utility method to know if a subscriber is known of the library
	 * 
	 * @param subscriber to
	 * @return false if the subscriber of the parameter is not known of the library
	 * @return true if the subscriber of the parameter is known of the library
	 */
	private boolean isASubscriber(Subscriber subscriber) throws BadParametersException, SubscriberExistsException {
		if (subscriber == null)
			throw new BadParametersException();
		
		if (subscriber.getNumber() == 0) return false;
		
		// If the object is in the list,
		// it is a known subscriber
		return this.subscribers.contains(subscriber);
	}

	/**
	 * Adds a new book to the library
	 * 
	 * @param book the book to be added
	 * @throws BadParametersException
	 * @throws BookExistsException
	 */
	public void addBook(Book book) throws BadParametersException,
			BookExistsException {
		if (book == null)
			throw new BadParametersException();

		// Look if the book is already in the library
		if (isABook(book))
			throw new BookExistsException();

		this.books.add(book);
	}

	/**
	 * This method add data about a new subscriber
	 * 
	 * @param s the subscriber to be added
	 * @return subscriber number
	 * @throws BadParametersException
	 * @throws SubscriberExistsException
	 */
	public long addSubscriber(Subscriber s) throws BadParametersException,
			SubscriberExistsException {
		if (s == null)
			throw new BadParametersException();

		// Do not subscribe more than once a subscriber
		if (isASubscriber(s))
			throw new SubscriberExistsException();

		this.subscribers.add(s);
		return s.getNumber();
	}

	/**
	 * This method deletes all data of a book from the library
	 * 
	 * @param book the book to delete
	 * @throws BadParametersException
	 * @throws BookExistsException
	 * @throws LentBookException
	 */
	public void deleteBook(Book book) throws BadParametersException, BookExistsException,
			LentBookException {
		if (book == null)
			throw new BadParametersException();

		// If the book does not exist, exception
		if (!isABook(book))
			throw new BookExistsException();


		// If the book is lent do not delete
		if (book.isLent())
			throw new LentBookException("Book lent. Cannot delete.");

		this.books.remove(book);
	}

	/**
	 * This method deletes data of a subscriber from the library
	 * @param subsNumber number of the subscriber
	 * @throws BadParametersException
	 * @throws SubscriberExistsException
	 */
	public void deleteSubscriber(Subscriber subscriber) throws BadParametersException,
			SubscriberWithLoansException, SubscriberExistsException {

		
		// If the number is not a subscriber number
		// raise exception
		if (!isASubscriber(subscriber))
			throw new SubscriberExistsException();

		// If loans, raise exception
		if (subscriber.existingLoans())
			throw new SubscriberWithLoansException();

		// Remove the subscriber
		this.subscribers.remove(subscriber);
	}

	/**
	 * Method to lend a book for a subscriber
	 * 
	 * @param book the book to be lent
	 * @param lender subscriber that whant to lend
	 * @return return date for the lent book
	 * @throws BadParametersException
	 * @throws BookExistsException
	 * @throws LentBookException
	 * @throws SubscriberExistsException
	 * @throws SubscriberWithLoansException
	 * @throws TooManyLoansException
	 */
	public Calendar lend(Book book, Subscriber lender) throws BadParametersException,
			BookExistsException, LentBookException, SubscriberExistsException, TooManyLoansException {

		if (book == null || lender == null)
			throw new BadParametersException();

		// Check if the book exists
		if (!isABook(book))
			throw new BookExistsException();

		// Check if the subscriber exists
		if (!isASubscriber(lender))
			throw new SubscriberExistsException();

		// Make the loan if possible
		Loan l = new Loan(book, lender);
		this.loans.add(l);
		return l.getReturnDate();
	}

	/**
	 * @return all books of the library
	 */
	public List<Book> listBooks() {
		return this.books.getContent();
	}

	/**
	 * Return the list of currrent loans
	 */
	public List<Loan> listLoans() {
		return this.loans.getContent();
	}

	/**
	 * @return all subscribers of the library
	 */
	public List<Subscriber> listSubscribers() {
		return this.subscribers.getContent();
	}

	/**
	 * This method returns the book book 
	 * @param book the book to be returned
	 * @throws BookExistsException
	 * @throws LentBookException
	 * @throws LoanExistsException 
	 */
	public void returnBook(Book book) throws BadParametersException, BookExistsException,
			LentBookException, LoanExistsException {
		if (book == null)
			throw new BadParametersException();

		// Check if the book exists
		if (!isABook(book))
			throw new BookExistsException();

		// Get the loan from the list
		Loan index = book.getLoan();
		
		// Ask the book to make return
		book.returnBook();

		// Delete the loan from my list
		loans.remove(index);
	}
}
