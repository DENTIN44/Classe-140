import React from 'react';  // Only import React, no need to import Component

class Third extends React.Component {
  constructor() {
    super();
    this.state = {
      data: [
        { "name": "Harry" },
        { "name": "Ron" },
        { "name": "Harmione" }
      ]
    };
  }

  render() {
    return (
      <div>
        <StudentName />
        <ul>
          {this.state.data.map((item) => <List data={item} />)}
        </ul>
      </div>
    );
  }
}

class StudentName extends React.Component {
  render() {
    return (
      <div>
        <h1>Student Name Detail</h1>
      </div>
    );
  }
}

class List extends React.Component {
  render() {
    return (
      <ul>
        <li>{this.props.data.name}</li>
      </ul>
    );
  }
}

export default Third;
