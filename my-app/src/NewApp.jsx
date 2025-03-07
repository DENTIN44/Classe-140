    
import React from 'react';

class NewApp extends React.Component {
   constructor(props) {
      super(props);

      this.state = {
         data: 0
      }
      this.setNewNumber = this.setNewNumber.bind(this)
   };
   setNewNumber() {
      this.setState({data: this.state.data + 1})
   }
   render() {
      return (
         <div>
            <button onClick = {this.setNewNumber}>INCREMENT</button>
            <Content myNumber = {this.state.data}></Content>
         </div>
      );
   }
}

class Content extends React.Component {
  // Replaces componentWillMount
  componentDidMount() {
    console.log('Component DID MOUNT!');
  }

  // Replaces componentWillReceiveProps
  static getDerivedStateFromProps(nextProps, prevState) {
    console.log('Deriving state from props...');
    return null; // Return null if no state update is needed
  }

  // Replaces componentWillUpdate
  componentDidUpdate(prevProps, prevState) {
    console.log('Component DID UPDATE!');
  }

  // Replaces componentWillUnmount
  componentWillUnmount() {
    console.log('Component WILL UNMOUNT!');
  }

  // Controls whether the component should re-render
  shouldComponentUpdate(nextProps, nextState) {
    return true; // Return true to allow re-render, false to prevent
  }

  render() {
    return (
      <div>
        <h3>{this.props.myNumber}</h3>
      </div>
    );
  }
}

export default NewApp; // Fixed export statement