const inputEl = document.querySelector('[data-el="input"]');
const highlightEl = document.querySelector('[data-el="highlight"]');
const outputEl = document.querySelector('[data-el="output"]');

const inputEl0 = document.querySelector('[data-el="input2"]');
const highlightEl0 = document.querySelector('[data-el="highlight2"]');
const outputEl0 = document.querySelector('[data-el="output2"]');


const inputEl1 = document.querySelector('[data-el="input3"]');
const highlightEl1 = document.querySelector('[data-el="highlight3"]');
const outputEl1 = document.querySelector('[data-el="output3"]');

const converter = new showdown.Converter({
	metadata: true,
	parseImgDimensions: true,
	strikethrough: true,
	tables: true,
	ghCodeBlocks: true,
	smoothLivePreview: true,
	simpleLineBreaks: true,
	emoji: true,
});

const resizeTextarea = (textArea) => {
	if (!textArea) {
		return;
	}


	window.requestAnimationFrame(() => {
		textArea.style.height = 0;
		if (textArea.scrollHeight > 0) {
			textArea.style.height = `${textArea.scrollHeight + 2}px`;
		}
	});
};

const highlight = (element) => {
	window.requestAnimationFrame(() => {
		const highlighted = hljs.highlight(
			"markdown",
			element.value
		).value;
		highlightEl.innerHTML = highlighted;
	});
};

const updateReadonly = (InElement, OutElement) => {
	window.requestAnimationFrame(() => {
		const htmlContent = converter.makeHtml(InElement.value);
		OutElement.innerHTML = htmlContent;
	});
};

const init = (inputEl, outputEl) => {
	inputEl.addEventListener("input", () => {
		resizeTextarea(inputEl);
		highlight(inputEl);
		updateReadonly(inputEl, outputEl);
	});
	inputEl.setAttribute('data-initialized', true);
}

document.addEventListener("DOMContentLoaded", () => {
	init(inputEl, outputEl);
	resizeTextarea(inputEl);
	highlight(inputEl);
	updateReadonly(inputEl, outputEl);

})


document.addEventListener("DOMContentLoaded", () => {
	init(inputEl0, outputEl0);
	resizeTextarea(inputEl0);
	highlight(inputEl0);
	updateReadonly(inputEl0, outputEl0);
})

document.addEventListener("DOMContentLoaded", () => {
	init(inputEl1, outputEl1);
	resizeTextarea(inputEl1);
	highlight(inputEl1);
	updateReadonly(inputEl1, outputEl1);
})
 




