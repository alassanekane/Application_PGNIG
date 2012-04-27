package loansManagement;

import java.io.Serializable;
import java.util.Calendar;

import subscribersManagement.Subscriber;
import booksManagement.Book;

public class LoanPK implements Serializable{
	
	private Calendar returnDate;
	private Book book;
	private Subscriber lender;
	
	public LoanPK(){
	}
	
	public Calendar getReturnDate() {
		return returnDate;
	}
	public void setReturnDate(Calendar returnDate) {
		this.returnDate = returnDate;
	}
	public Book getBook() {
		return book;
	}
	public void setBook(Book book) {
		this.book = book;
	}
	public Subscriber getLender() {
		return lender;
	}
	public void setLender(Subscriber lender) {
		this.lender = lender;
	}
	/* (non-Javadoc)
	 * @see java.lang.Object#hashCode()
	 */
	@Override
	public int hashCode() {
		final int prime = 31;
		int result = 1;
		result = prime * result + ((book == null) ? 0 : book.hashCode());
		result = prime * result + ((lender == null) ? 0 : lender.hashCode());
		result = prime * result
				+ ((returnDate == null) ? 0 : returnDate.hashCode());
		return result;
	}
	/* (non-Javadoc)
	 * @see java.lang.Object#equals(java.lang.Object)
	 */
	@Override
	public boolean equals(Object obj) {
		if (this == obj)
			return true;
		if (obj == null)
			return false;
		if (getClass() != obj.getClass())
			return false;
		LoanPK other = (LoanPK) obj;
		if (book == null) {
			if (other.book != null)
				return false;
		} else if (!book.equals(other.book))
			return false;
		if (lender == null) {
			if (other.lender != null)
				return false;
		} else if (!lender.equals(other.lender))
			return false;
		if (returnDate == null) {
			if (other.returnDate != null)
				return false;
		} else if (!returnDate.equals(other.returnDate))
			return false;
		return true;
	}
	
	
}
