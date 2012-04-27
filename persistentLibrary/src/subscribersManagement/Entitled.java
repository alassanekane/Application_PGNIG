/**
 * 
 */
package subscribersManagement;

import java.io.Serializable;
import java.util.ArrayList;
import java.util.Calendar;

import javax.persistence.*;

import loansManagement.Loan;
import exceptions.BadParametersException;

/** 
 * @author user
 */
@Entity
@PrimaryKeyJoinColumn(name="entitled_id")
@Table(name="entitled")
public class Entitled extends Subscriber implements Serializable {

	private static final long serialVersionUID = 1L;
	
	/**
	 * 
	 */
	public Entitled() {
		// TODO Auto-generated constructor stub
		super();
	}

/**
 * Constructor of a subscriber Generates the number of the subscriber
 * 
 * @params firstName first name of the subscriber
 * @params lastName last name of the subscriber
 * @params bornDate born date of the subscriber
 * @throws BadParametersException
 */

	public Entitled(String firstName, String lastName, Calendar bornDate, Subscriber subscriber)
			throws BadParametersException {
		super (firstName, lastName, bornDate);
		if (subscriber == null)
			throw new BadParametersException();
		this.mainSubscriber=subscriber;
	}


	/** 
	 * @uml.property name="mainSubscriber"
	 * @uml.associationEnd inverse="entitles:subscribersManagement.Subscriber"
	 * @uml.association name="subscriberEntitled"
	 */
	@ManyToOne(cascade = CascadeType.ALL)
	@JoinColumn(name = "subscriber_ref")
	private Subscriber mainSubscriber;

	public String toString() {
		return super.toString() + " as entitled of " + this.mainSubscriber.toString();
	}

	/** 
	 * Getter of the property <tt>mainSubscriber</tt>
	 * @return  Returns the subscriber.
	 * @uml.property  name="mainSubscriber"
	 */
	public Subscriber getMainSubscriber() {
		return mainSubscriber;
	}

	/** 
	 * Setter of the property <tt>mainSubscriber</tt>
	 * @param mainSubscriber  The subscriber to set.
	 * @uml.property  name="mainSubscriber"
	 */
	public void setMainSubscriber(Subscriber mainSubscriber) {
		if (this.mainSubscriber != null) {
			if (this.mainSubscriber == mainSubscriber) return;
			else {
				// this.mainSubscriber.removeEntitled(this);
			}
		}
		this.mainSubscriber = mainSubscriber;
		//this.mainSubscriber.addEntitled(this);
		
	}

}
