import { omit } from 'lodash';
import '../../styles/components/Button.scss';

const Button = props => {
    const filteredProps = omit(props, ['icon', 'className', 'children']);

    return (
        <button {...filteredProps} className="Button">
            <i className={`Button__icon fa-light fa-${props?.icon || 'question-circle'}`}></i>
            <div className="Button__content">
                {props.children}
            </div>
        </button>
    );
}

export default Button;