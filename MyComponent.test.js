import '@testing-library/jest-dom';
import { render, screen, fireEvent } from '@testing-library/react';
import { act } from 'react';
import React, { useState } from 'react';

// Sample component that updates state asynchronously
function MyComponent() {
  const [text, setText] = useState('Initial');

  const updateText = () => {
    setTimeout(() => {
      setText('Updated');
    }, 1000);
  };

  return (
    <div>
      <p>{text}</p>
      <button onClick={updateText}>Update</button>
    </div>
  );
}

// Test case
test('updates text after button clicked', async () => {
  render(<MyComponent />);

  await act(async () => {
    fireEvent.click(screen.getByText('Update'));
  });

  // Wait for the state update
  await act(async () => {
    await new Promise((resolve) => setTimeout(resolve, 4000));
  });

  expect(screen.getByText('Updated')).toBeInTheDocument();
});