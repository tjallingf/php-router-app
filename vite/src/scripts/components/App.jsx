import { useState } from 'react';
import '../../styles/components/App.scss';

const App = () => {
    const [ count, setCount ] = useState(10);

    return (
        <div className="App">
            <h3>This is a React component</h3>
            <p>Count: {count}</p>
            <button onClick={() => setCount(cur => cur + 1)}>Increment</button>
            <button onClick={() => setCount(cur => cur - 1)}>Decrement</button>
        </div>
    );
}

export default App;