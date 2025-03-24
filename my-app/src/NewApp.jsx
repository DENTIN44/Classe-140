import React from 'react';

class NewApp extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      data: 0,
      showContent: true, // Add a state to control Content visibility
    };
    this.setNewNumber = this.setNewNumber.bind(this);
    this.toggleContent = this.toggleContent.bind(this); // Add a method to toggle Content
  }

  setNewNumber() {
    this.setState({ data: this.state.data + 1 });
  }

  toggleContent() {
    this.setState((prevState) => ({ showContent: !prevState.showContent }));
  }

  render() {
    return (
      <div>
        <button onClick={this.setNewNumber}>INCREMENT</button>
        <button onClick={this.toggleContent}>
          {this.state.showContent ? 'Hide Content' : 'Show Content'}
        </button>
        {this.state.showContent && <Content myNumber={this.state.data} />}
      </div>
    );
  }
}

class Content extends React.Component {
  componentDidMount() {
    console.log('Component DID MOUNT!');
  }

  static getDerivedStateFromProps(nextProps, prevState) {
    console.log('Deriving state from props...');
    return null; // No state update needed
  }

  componentDidUpdate(prevProps, prevState) {
    console.log('Component DID UPDATE!');
  }

  componentWillUnmount() {
    console.log('Component WILL UNMOUNT!');
  }

  shouldComponentUpdate(nextProps, nextState) {
    // Example logic to prevent unnecessary re-renders
    if (nextProps.myNumber === this.props.myNumber) {
      return false;
    }
    return true;
  }

  render() {
    return (
      <div>
        <h3>{this.props.myNumber}</h3>
      </div>
    );
  }
}

export default NewApp;