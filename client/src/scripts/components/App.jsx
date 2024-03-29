import { useState } from 'react';
import Button from './Button';

const App = () => {
    const [ counter, setCounter ] = useState(0);

    return (
        <div className="p-5">
            <div className="card">
                <div className="card-body">
                    <h4 className="card-title">Counter: <b>{counter}</b></h4>
                    <div className="card-text">
                        <div className="row gx-2 flex-nowrap">
                            <div className="col-auto">
                                <Button 
                                    icon="plus"
                                    background="success"
                                    onClick={() => setCounter(cur => cur+1)}>
                                    Increment</Button>
                            </div>
                            <div className="col-auto">
                                <Button 
                                    icon="minus"
                                    background="danger"
                                    onClick={() => setCounter(cur => cur-1)}>
                                    Decrement</Button>
                            </div>
                            <div className="col-auto">
                                <Button 
                                    icon="undo"
                                    background="info"
                                    onClick={() => setCounter(0)}>
                                    Reset</Button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default App;